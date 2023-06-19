<?php

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use \Illuminate\Support\Facades\DB;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use App\Mail\NewContact;
use Illuminate\Support\Facades\Mail;


function images($image) //Regresa la url del repositorio de imagenes + el nombre de la imagen
{
    return config('constants.IMAGES_REPOSITORY') . $image;
}

function imgURL($data)
{
    if (!isset($data)) {
        return false;
    }
    $metadatos = unserialize($data);
    // return images($metadatos['file']);
    return images((isset($metadatos['s3']['formats']['webp'])) ? $metadatos['s3']['formats']['webp'] : $metadatos['file']);
}

function img_meta($data, $alt = false, $lazy = true)
{
    if (!isset($data)) {
        return false;
    }

    $metadatos = unserialize($data);
    // dd($metadatos["sizes"]);
    $img_meta = [
        ($metadatos['image_meta']['title']) ? 'alt="' . $metadatos['image_meta']['title'] . '"' : 'title=""',
        // 'width="425"',
        // 'height="250"',
        'width="' . $metadatos['width'] . '"',
        'height="' . $metadatos['height'] . '"',
        'src="' . images((isset($metadatos["sizes"]["medium_large"]["s3"]["url"])) ? $metadatos["sizes"]["medium_large"]["s3"]["url"] : $metadatos['file']) . '"',
        ($alt) ? 'alt="' . $alt . '"' : 'alt="Alt Text"',
        ($lazy) ? 'loading="lazy"' : '',
        ($lazy) ? 'decoding="defer"' : '',
        // 'sizes="(max-width: 300px) 100vw, 300px"',
        'sizes="(max-width: 200px) 200px,(max-width: 425px) 425px, (max-width: 550px) 525px, (max-width: 800px) 800px, (max-width: 1024px) 1024px, 1024px"',
        'srcset="' . images((isset($metadatos['s3']['formats']['webp'])) ? $metadatos['s3']['formats']['webp'] : $metadatos['file']) . ' ' . $metadatos['width'] . 'w, ' . imgMetaSrcSet($metadatos['sizes']) . '"'
    ];
    return implode(" ", $img_meta);
}

function imgMetaSrcSet($metasizes)
{
    $allsizes = [];
    foreach ($metasizes as $size) {
        $ruta = images((isset($size['s3']['formats']['webp'])) ? $size['s3']['formats']['webp'] : $size['s3']['key']) . ' ' . $size['width'] . 'w';
        array_push($allsizes, $ruta);
    }
    return implode(',', $allsizes);
}

function imgMetaSizes($metasizes)
{
    $allsizes = [];
    foreach ($metasizes as $size) {
        $ruta = images((isset($size['s3']['formats']['webp'])) ? $size['s3']['formats']['webp'] : $size['s3']['key']) . ' ' . $size['width'] . 'w';
        array_push($allsizes, $ruta);
    }
    return implode(',', $allsizes);
}

function ValidateAvaliable($array)
{
    $horario = unserialize($array);
    $bandera = false;
    for ($i = 1; $i <= 7; $i++) {
        if ($horario[$i]['off'] != 1 && $horario[$i]['hours'] != '') {
            $bandera = true;
        }
    }
    return $bandera;
}

function paginate($items, $perPage = 5, $page = null, $options = [])
{
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator(
        $items->forPage($page, $perPage),
        $items->count(),
        $perPage,
        $page,
        ['path' => Paginator::resolveCurrentPath()]
    );
}

function returndata($typedata)
{
    switch ($typedata) {
        case 'categories':
            $data = DB::select("SELECT * FROM travel_categories WHERE slug != 'sin-categoria'");
            break;
        case 'destinations':
            $data = DB::select("SELECT * FROM travel_destinations;");
            break;
        case 'tags':
            $data = DB::select("SELECT t.term_id,t.name,t.slug, tm.meta_value FROM travel_terms t
                                INNER JOIN travel_termmeta tm ON t.term_id=tm.term_id
                                INNER JOIN travel_term_taxonomy ttt ON t.term_id=ttt.term_id
                                WHERE tm.meta_key = 'cc_color' AND ttt.taxonomy = 'post_tag'");
            break;
        case 'gallery':
            $data = DB::select("SELECT
                                        pm1.post_id,
                                        pm1.meta_value AS metadata,
                                        pm2.meta_value AS img_alt
                                    FROM
                                        tribunetravel_wp.travel_postmeta AS pm1
                                            LEFT JOIN
                                        tribunetravel_wp.travel_postmeta AS pm2 ON pm1.post_id = pm2.post_id
                                            AND pm2.meta_key = '_wp_attachment_image_alt'
                                    WHERE
                                        pm1.meta_key = '_wp_attachment_metadata'
                                            AND pm1.post_id IN (23917 , 23916, 23915, 23914, 23913, 23912);");
            break;
        default:
            break;
    }
    return $data;
}

function category($category, $destination)
{
    $pagination = 8;
    if ($destination == '' || $category == 'daily-briefing') {
        //$data = Post::taxonomy('category', $category)->status('publish')->latest();
        $post = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = '$category' ORDER BY post_date DESC");
    } else {
        $post = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = '$category' AND destination_slug = '$destination' ORDER BY post_date DESC");
    }

    $data = paginate($post, $pagination)->onEachSide(0);
    return $data;
}

function metadatos($title, $description, $image, $url, $url_canonical, $noindex = null)
{
    SEOTools::setTitle($title);
    SEOTools::setDescription($description);
    SEOTools::setCanonical($url_canonical);
    if ($noindex) {
        SEOMeta::setRobots('noindex,nofollow');
    } else {
        SEOMeta::setRobots('index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1');
    }
    SEOTools::opengraph()->setTitle($title);
    SEOTools::opengraph()->setUrl($url);
    SEOTools::opengraph()->addProperty('type', 'website');
    SEOTools::opengraph()->addImage($image, ['secure_url' => $image, 'width' => 300, 'height' => 300, 'type' => 'image/jpeg', "itemprop" => "image"]);

    SEOTools::twitter()->setTitle($title);
    SEOTools::twitter()->setSite('@CpsNoticias');
    SEOTools::twitter()->setUrl($url);
    SEOTools::twitter()->setImage($image, ['width' => 300, 'height' => 300, 'type' => 'image/jpeg']);
}

function data_json_event($data)
{
    $array_event = [];

    for ($i = 0; $i < count($data); $i++) {
        $img_metadata = unserialize($data[$i]->image_data);
        $image = images((isset($img_metadata['s3']['formats']['webp'])) ? $img_metadata['s3']['formats']['webp'] : $img_metadata['file']);
        $content = $data[$i]->content;
        //$formatted_text = str_replace(['<p style="text-align: left;">', '</p>'], '', $content);
        //dd($formatted_text);
        array_push($array_event, [
            "@type" => "Event",
            "name" => $data[$i]->title,
            "startDate" => $data[$i]->start_date,
            "endDate" => $data[$i]->end_date,
            "location" => $data[$i]->destination,
            "image" => $image,
            'description' => $data[$i]->title
        ]);
    }
    JsonLdMulti::addValue("Event", $array_event);


    return JsonLdMulti::generate();
}

function GetTagsPosts($posts_list)
{
    $array = [];
    foreach ($posts_list as $key) {
        array_push($array, $key->ID);
    }
    $list = implode(",", $array);
    $guide_tags = DB::select("SELECT
                                    t.term_id, t.name
                                FROM
                                    travel_term_relationships AS tr,
                                    travel_term_taxonomy AS tt,
                                    travel_terms as t
                                WHERE
                                    tr.term_taxonomy_id = tt.term_taxonomy_id
                                        AND tt.taxonomy = 'listdom-tag'
                                        AND tt.term_id = t.term_id
                                        AND tr.object_id IN ($list)
                                        GROUP BY t.term_id
                                        ORDER BY t.name;");
    return $guide_tags;
}

function get_img_gallery($destination, $category)
{
    $galleries = [];
    $posts = DB::select("SELECT * FROM travel_directory WHERE location = '$destination' AND category_id = '$category' AND label IN (21,22);");
    foreach ($posts as $post) {
        $imgs = [];
        $post_gallery = unserialize($post->gallery);
        foreach ($post_gallery as $key) {
            $data = DB::select("SELECT
                                        meta_value AS img
                                    FROM
                                        tribunetravel_wp.travel_postmeta
                                    WHERE
                                        post_id = $key
                                            AND meta_key = '_wp_attached_file';");
            array_push($imgs, $data[0]->img);
        }
        $galleries["gallery-" . $post->ID] = $imgs;
    }
    return $galleries;
}

function GetIconWeather($id)
{
    $icons = [
        "1" => "bi bi-sun-fill",
        "11" => "bi bi-wind",
        "18" => "bi bi-cloud-drizzle-fill",
        "19" => "bi bi-cloud-drizzle-fill",
        "1n" => "bi bi-moon-fill",
        "2" => "bi bi-sun-fill",
        "21" => "bi bi-cloud-lightning-rain-fill",
        "21n" => "bi bi-cloud-lightning-rain-fill",
        "22" => "bi bi-cloud-lightning-rain-fill",
        "24" => "bi bi-cloud-hail-fill",
        "25" => "bi bi-hurricane",
        "28" => "bi bi-cloud-snow-fill",
        "29" => "bi bi-cloud-sleet-fill",
        "2n" => "bi bi-moon-fill",
        "30" => "bi bi-cloud-snow-fill",
        "33" => "bi bi-cloud-rain-heavy-fill",
        "33n" => "bi bi-cloud-rain-heavy-fill",
        "4" => "bi bi-cloud-sun-fill",
        "4n" => "bi bi-cloud-moon-fill",
        "51" => "bi bi-cloud-snow-fill",
        "51n" => "bi bi-cloud-snow-fill",
        "54" => "bi bi-cloudy-fill",
        "6" => "bi bi-clouds-fill",
        "6n" => "bi bi-clouds-fill",
        "7" => "bi bi-clouds-fill",
        "9" => "bi bi-cloudy-fill",
        "9n" => "bi bi-cloudy-fill",
        "nd" => "bi bi-umbrella-fill"
    ];
    return $icons[$id];
}

function GetWeather()
{
    $data = [];
    $locations_weather = DB::select("SELECT * FROM travel_weather;");
    // dd($locations_weather);
    foreach ($locations_weather as $weather) {
        $info = json_decode($weather->info);
        // date_default_timezone_set('Europe/Madrid');//Se pone esta zona horario, porque en esta nos la arroja la API
        foreach ($info->hour_hour as $w) {
            date_default_timezone_set($weather->timezone);
            $location_hour = date("Y-n-j G:00");

            $api_hour = $w->date . ' ' . $w->hour_data;
            if ($weather->slug == 'Vallarta') {
                $new_date = strtotime('-6 hour', strtotime($w->hour_data));
                $api_hour = date('Y-n-j G:00', $new_date);
                // dd($api_hour);
            }
            //  dd($location_hour);
            if ($api_hour != $location_hour) { //Obtener el clima de la hora actual(Revisar este bug)
                $n = $weather->slug;
                $icon = GetIconWeather($w->icon);
                $i = [
                    "text" => $w->text . ' (' . $w->date . ' ' . $w->hour_data . ')',
                    "temperature" => $w->temperature . ' ' . $info->information->temperature,
                    "icon" => $icon,
                    "tz" => $weather->timezone
                ];
                $data[$n] = $i;
            }
        }
    }
    // dd($data);
    return $data;
}

function send_email($data)
{
    $query = "SELECT description FROM tribunetravel_wp.travel_contact_subject where id_subject = $data->id_subject";
    $new_contact = DB::select($query);
    $new_array = array($data);
    array_push($new_array, $new_contact);
    //dd($new_array);
    Mail::to("info@lifeasbrand.com")->bcc('digital@cps.media', 'francisco.moras@lifeasbrand.com')
        ->send(new NewContact($new_array));
}

function check_subscription($email, $id_category)
    {
        $query = "SELECT
        travel_subscriptions_category.id_term,travel_subscriptions_category.status
        FROM tribunetravel_wp.travel_subscriptions JOIN
        tribunetravel_wp.travel_subscriptions_category
        ON travel_subscriptions.id_subscriptions = travel_subscriptions_category.id_subscription
        WHERE travel_subscriptions.email='$email' AND travel_subscriptions_category.id_term = $id_category ";
        $check_id_category = DB::select($query);
        if ($check_id_category) {

            return $check_id_category;
        } else {
            return $check_id_category = [''];
        }
    }