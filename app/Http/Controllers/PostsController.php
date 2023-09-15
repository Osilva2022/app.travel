<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostAll;
use Illuminate\Contracts\View\View;
use \Illuminate\Support\Facades\DB;
use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;
use App\Models\InstagramTokens;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;
use DateTime;
use Artesaos\SEOTools\Facades\JsonLdMulti;


class PostsController extends Controller
{

    /**
     * Obtener las imágenes de una cuenta de instagram a traves de un api
     * Se genera un token cada 30 días y se guarda en la tabla travel_instagram_tokens con un cronjob
     */
    function instagram()
    {
        $instagramtoken = InstagramTokens::find(1);
        $token = $instagramtoken->token;

        $instagram = new InstagramBasicDisplay($token);
        $instagram->setAccessToken($token);
        // $t = $instagram->getAccessToken();
        // $tt = $instagram->refreshToken($token,true);
        $media = $instagram->getUserMedia('me', 6);
        return $media;
    }
    /**
     * Funcion para mostrar un previews de un post desde Wordpress
     *
     */
    function preview($id)
    {
        $posts = DB::select("SELECT
                                    *
                                FROM
                                    travel_posts_all
                                        LEFT JOIN
                                    (SELECT
                                        u.user_id,
                                            p.meta_value AS avatar
                                    FROM
                                        travel_usermeta AS u, travel_postmeta AS p
                                    WHERE
                                        u.meta_key = 'travel_user_avatar'
                                            AND u.meta_value = p.post_id
                                            AND p.meta_key = '_wp_attached_file') AS q ON travel_posts_all.author_id = q.user_id
                                WHERE
                                    id_post = $id
                                ORDER BY post_date DESC;");

        $post = $posts[0];
        $category = $post->category_slug;
        $destino = $post->destination_slug;
        $more_posts = DB::select("SELECT * FROM travel_posts_category
            WHERE category_slug = '$post->category_slug'
            AND id_post != $post->id_post
                ORDER BY post_date DESC
                LIMIT 3;");
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        return view('posts.index', compact('post', 'more_posts', 'category', 'destino', 'destinations_data', 'categories_data'));
    }

    function mapxml()
    {

        $sitemapIndexes = [];

        $now = Carbon::now()->setTimezone(config('region.timezone'));
        // Create the general pages sitemap.
        $generalPagesSitemap = Sitemap::create();
        // Add homepage.
        $generalPagesSitemap->add(
            Url::create(config('app.url'))
                ->setLastModificationDate($now)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0)
        );

        $generalPagesSitemap->add(
            Url::create(config('app.url') . '/')
                ->setLastModificationDate($now)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0)
        );

        // Add all categories pages.
        $categories = DB::select("SELECT CONCAT(d.slug,'/guide/',C.slug) as slug FROM travel_destinations d JOIN travel_directory_category C;");

        foreach ($categories as $category) {
            $url = config('app.url') . $category->slug;

            $generalPagesSitemap->add(
                Url::create($url)
                    ->setLastModificationDate($now)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8)
            );
        }

        // Add the sitemap to the indexes variable.
        $sitemapsIndex[] = '/sitemaps/pages_sitemap.xml';

        $postsSitemapCount = 1;
        // Create the posts sitemaps.
        $postsSite = PostALL::all()->chunk(100);

        foreach ($postsSite as $posts) {

            $postsSitemap = Sitemap::create();

            foreach ($posts as $post) {

                $lastMod = new DateTime($post->post_date);

                $postsSitemap->add(
                    Url::create($post->url)
                        ->setLastModificationDate($lastMod)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                        ->setPriority(0.4)
                );
            }
            // Add the sitemap to the indexes variable.
            // $postsSitemap->writeToFile(public_path('sitemap/posts_sitemap_'.$postsSitemapCount.'.xml'));
            $postsSitemap->writeToFile(storage_path('app/sitemaps/posts_sitemap_' . $postsSitemapCount . '.xml'));
            // $postsSitemap->writeToFile(storage_path('app/sitemaps/posts_sitemap_'.$postsSitemapCount.'.xml'));
            $sitemapsIndex[] = '/sitemaps/posts_sitemap_' . $postsSitemapCount . '.xml';
            $postsSitemapCount++;
        }

        // Create the indexes sitemap.
        $indexesSitemap = SitemapIndex::create();
        // Add the indexes to the sitemap.
        foreach ($sitemapsIndex as $index) {
            $indexesSitemap->add($index);
        }
        // Create the sitemap to a file.
        $generalPagesSitemap->writeToFile(storage_path('app/sitemaps/pages_sitemap.xml'));
        $indexesSitemap->writeToFile(storage_path('app/sitemaps/sitemap.xml'));
        // dd($postsSitemap);
    }

    public function index(Request $request)
    {
        //Previews post
        if (isset($request->p)) {
            $id = $request->p;

            $validate = PostAll::where('id_post', $id)->first();

            if (is_null($validate)) {
                // return abort(404);
                return redirect()->route('home');
            }
            return $this->preview($id);
        }

        $destinations = DB::select("SELECT * FROM travel_destinations");
        $tags_data = DB::select("SELECT t.term_id,t.name FROM travel_terms t , travel_term_taxonomy ttt
                                WHERE t.term_id=ttt.term_id AND ttt.taxonomy = 'post_tag'");
        $categories_data = returndata('categories');

        $review = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'reviews' ORDER BY post_date DESC LIMIT 1");
        $reviews = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'reviews' ORDER BY post_date DESC LIMIT 5");


        $guide = DB::select("SELECT
                                    td.ID,
                                    td.category,
                                    td.category_slug,
                                    td.destination,
                                    td.destination_slug,
                                    td.post_title,
                                    td.label,
                                    td.image_data,
                                    td.image_alt
                                FROM
                                    travel_guide td
                                    WHERE td.label = 22
                                ORDER BY td.destination_slug , td.category_slug;"); //Label '22' = VIP+
        //dd($things);
        $new = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'news' ORDER BY post_date DESC LIMIT 1");
        $news = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'news' ORDER BY post_date DESC LIMIT 5");
        $daily = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'daily-briefing' ORDER BY post_date DESC LIMIT 1");
        $dailys = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'daily-briefing' ORDER BY post_date DESC LIMIT 5");
        $thing = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'things-to-do' ORDER BY post_date DESC LIMIT 1");
        $things = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'things-to-do' ORDER BY post_date DESC LIMIT 5");
        $blog = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'blogs' ORDER BY post_date DESC LIMIT 1");
        $blogs = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'blogs' ORDER BY post_date DESC LIMIT 5");
        $event = DB::select("SELECT * FROM travel_events WHERE start_date >= current_date() ORDER BY start_date ASC LIMIT 4");
        $divisas_data = DB::select("SELECT * FROM travel_divisa WHERE country != 'USD'");
        $usd_data = DB::select("SELECT * FROM travel_divisa WHERE country = 'USD'");
        $usd = $usd_data[0];

        // dd($divisas_data);

        //Revisar issue de instagram
        // $gallery = $this->instagram();
        // if (isset($gallery)) {
        //     $gallery = $gallery->data;
        // } else {
        //     $gallery = false;
        // }
        $gallery = false;

        $static_gallery = returndata('gallery');
        $gallery = $static_gallery;

        metadatos(
            config('constants.META_TITLE'),
            config('constants.META_DESCRIPTION'),
            "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/11/tt.png",
            // "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/10/home-tt.png",
            config('constants.META_URL'),
            config('constants.META_URL')
        );
        // $this->ApiWeather();
        $weather = GetWeather();
        // dd($weather);



        return view('layouts.index', compact('reviews', 'review', 'guide', 'news', 'new', 'dailys', 'daily', 'things', 'thing', 'destinations', 'tags_data', 'event', 'categories_data', 'gallery', 'blog', 'blogs', 'divisas_data', 'usd', 'weather'));
    }

    public function post($destino, $category, $slug): View
    {
        $array = [];
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        $apiresponse = json_decode(file_get_contents('https://admin.tribune.travel/wp-json/wp/v2/posts?slug=' . $slug));
        empty($apiresponse) || $apiresponse[0]->status != "publish" ? abort(404) : true;
        $img_id = isset($apiresponse[0]) ? $apiresponse[0]->featured_media : '';
        $imgdata = DB::select("SELECT * FROM tribunetravel_wp.travel_media WHERE ID = $img_id;");
        $imgdata = empty($imgdata) ? '' : $imgdata[0];
        $author_id = isset($apiresponse[0]) ? $apiresponse[0]->author : '';
        $authordata = DB::select("SELECT * FROM tribunetravel_wp.travel_author WHERE user_id = $author_id;");
        $authordata = empty($authordata) ? '' : $authordata[0];
        // dd($apiresponse);
        $category_name = "";
        $category_color = "";
        $portada_diarios = false;
        if ($apiresponse[0]->acf->portada_diarios) {
            $query = DB::select("SELECT guid FROM travel_posts WHERE ID = " . $apiresponse[0]->acf->portada_diarios);
            $portada_diarios = $query[0]->guid;
        }
        foreach ($categories_data as $c) {
            if ($c->term_id == $apiresponse[0]->categories[0]) {
                // dd($c);
                $category_name = $c->name;
                $category_color = $c->color;
            }
        }
        $destination_name = "";
        $destination_color = "";
        foreach ($destinations_data as $c) {
            if ($c->term_id == $apiresponse[0]->post_destinos[0]) {
                // dd($c);
                $destination_name = $c->name;
                $destination_color = $c->color;
            }
        }
        $post_ = [
            "slug" => $apiresponse[0]->slug,
            "date" => $apiresponse[0]->date,
            "id" => $apiresponse[0]->id,
            "category" => $category,
            "category_name" => $category_name,
            "category_color" => $category_color,
            "destination" => $destino,
            "destination_name" => $destination_name,
            "destination_color" => $destination_color,
            "title" => $apiresponse[0]->title->rendered,
            "subtitle" => $apiresponse[0]->acf->subtitle,
            "excerpt" => $apiresponse[0]->excerpt->rendered,
            "content" => $apiresponse[0]->content->rendered,
            "seo_title" => $apiresponse[0]->acf->titulo_seo,
            "post_format" => $apiresponse[0]->acf->post_format,
            "video_code" => $apiresponse[0]->acf->video_code,
            "seo_description" => $apiresponse[0]->acf->descripcion_seo,
            "portada_diarios" => $portada_diarios,
            "canonical_url" => $apiresponse[0]->acf->url_canonica,
            "img" => $imgdata,
            "author" => $authordata
        ];
        // dd($post_);
        $img_metadata = unserialize($post_['img']->img_data);
        $image = images((isset($img_metadata['s3']['formats']['webp'])) ? $img_metadata['s3']['formats']['webp'] : $img_metadata['file']);
        array_push($array, [
            "@type" => "author",
            "name" => $post_['author']->name,
            "url" => route('author', $post_['author']->user_nicename),
            "datePublished" => $post_['date'],
        ]);
        JsonLdMulti::setTitle($post_['seo_title']);
        JsonLdMulti::setDescription($post_['seo_description']);
        JsonLdMulti::setType('Article');
        JsonLdMulti::addImage($image);
        JsonLdMulti::addValue("author", $array);
        JsonLdMulti::addValue("headline", $post_['seo_title']);

        if (!JsonLdMulti::isEmpty()) {
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('WebPage');
            JsonLdMulti::setTitle('Page Article - ' . $post_['title']);
        }
        $id = $post_['id'];
        $more_posts = DB::select("SELECT * FROM travel_posts_category
                                    WHERE category_slug = '$category'
                                    AND id_post != $id
                                        ORDER BY post_date DESC
                                        LIMIT 3;");
        $post_tags = DB::select("SELECT
                                    tags.name, tags.slug, tags.description, tags.color
                                FROM
                                    travel_tags AS tags,
                                    (SELECT
                                        `t`.`slug` AS `tag_slug`, `tr`.`object_id` AS `id_post`
                                    FROM
                                        `travel_terms` `t`
                                    JOIN `travel_term_taxonomy` `tt`
                                    JOIN `travel_term_relationships` `tr`
                                    WHERE
                                        `t`.`term_id` = `tt`.`term_id`
                                            AND `tt`.`taxonomy` = 'post_tag'
                                            AND `tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`) AS posts_tags
                                WHERE
                                    tags.slug = posts_tags.tag_slug
                                        AND id_post = $id;");
        // dd($post_);
        metadatos(
            isset($post_['seo_title']) ? $post_['seo_title'] : $post_['title'],
            isset($post_['seo_description']) ? $post_['seo_description'] : strip_tags($post_['excerpt']),
            isset($post_["img"]->ID) ? imgURL($post_["img"]->img_data) : config('constants.DEFAULT_IMAGE'),
            route('post', [$destino, $category, $post_['slug']]),
            (isset($post_['canonical_url']) && $post_['canonical_url'] != '') ? $post_['canonical_url'] : route('post', [$destino, $category, $post_['slug']])
        );
        $destination = $destino;

        return view('posts.index', compact('post_', 'more_posts', 'category', 'destino', 'destinations_data', 'categories_data', 'post_tags', 'destination'));
    }

    public function postid($id)
    {
        $posts = DB::select("SELECT
                                    *
                                FROM
                                    travel_posts_all
                                        LEFT JOIN
                                    (SELECT
                                            u.user_id, p.meta_value AS avatar, us.user_nicename
                                        FROM
                                            travel_users AS us
                                            left join
                                            travel_usermeta AS u on us.ID = u.user_id AND u.meta_key = 'travel_user_avatar'
                                            left join
                                            travel_postmeta AS p on u.meta_value = p.post_id AND p.meta_key = '_wp_attached_file') AS q
                                    ON travel_posts_all.author_id = q.user_id
                                WHERE
                                    id_post = '$id'
                                ORDER BY post_date DESC;");
        // $post = $posts[0];
        $post = (isset($posts[0])) ? $posts[0] : abort(404);

        $more_posts = DB::select("SELECT * FROM travel_posts_category
                                    WHERE category_slug = '$post->category_slug'
                                    AND id_post != $post->id_post
                                        ORDER BY post_date DESC
                                        LIMIT 3;");
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        $post_tags = DB::select("SELECT
                                    tags.name, tags.slug, tags.description, tags.color
                                FROM
                                    travel_tags AS tags,
                                    (SELECT
                                        `t`.`slug` AS `tag_slug`, `tr`.`object_id` AS `id_post`
                                    FROM
                                        `travel_terms` `t`
                                    JOIN `travel_term_taxonomy` `tt`
                                    JOIN `travel_term_relationships` `tr`
                                    WHERE
                                        `t`.`term_id` = `tt`.`term_id`
                                            AND `tt`.`taxonomy` = 'post_tag'
                                            AND `tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`) AS posts_tags
                                WHERE
                                    tags.slug = posts_tags.tag_slug
                                        AND id_post = $post->id_post;");
        metadatos(
            isset($post->meta_title) ? $post->meta_title : $post->title,
            isset($post->meta_description) ? $post->meta_description : $post->post_excerpt,
            isset($post->image_data) ? imgURL($post->image_data) : config('constants.DEFAULT_IMAGE'),
            route('post', [$post->destination_slug, $post->category_slug, $post->slug]),
            route('post', [$post->destination_slug, $post->category_slug, $post->slug])
        );
        $destination = $post->destination_slug;
        $destino = $post->destination_slug;
        $category = $post->category;
        // dd($destination);

        return view('posts.index', compact('post', 'more_posts', 'category', 'destino', 'destinations_data', 'categories_data', 'post_tags', 'destination'));
    }

    public function PostsTags(Request $request)
    {
        if (isset($request->tags) && $request->tags != "") {
            $tag_ids = $request->tags;
            $posts = DB::select("SELECT tr.object_id
                        FROM
                            travel_term_relationships AS tr,
                            travel_term_taxonomy AS tt
                        WHERE
                            tr.term_taxonomy_id = tt.term_taxonomy_id
                                AND taxonomy = 'listdom-tag'
                                AND term_id IN ($tag_ids)");
            if (is_null($posts)) {
                return "xox"; //No hay posts
            }
            $array = [];
            foreach ($posts as $key) {
                array_push($array, $key->object_id);
            }
            // dd($array);
            return implode(',', $array);
        } else {
            return "xox";
        }
    }

    public function tags($tag)
    {
        $posts = DB::select("SELECT * FROM travel_posts_tag WHERE tag_slug = '$tag' ORDER BY post_date DESC;");
        $destinationposts = paginate($posts, 9)->onEachSide(0);
        $tag_data = DB::select("SELECT * FROM travel_tags WHERE slug = '$tag';");
        $tags_data = DB::select("SELECT * FROM travel_tags;");
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        metadatos(
            isset($tag_data[0]->name) ? 'Tribune Travel | ' . str_replace('&amp;', '&', $tag_data[0]->name) : config('constants.META_TITLE'),
            isset($tag_data[0]->meta_description) ? $tag_data[0]->meta_description : config('constants.META_DESCRIPTION'),
            config('constants.DEFAULT_IMAGE'),
            route('tags', $tag_data[0]->slug),
            route('tags', $tag_data[0]->slug)
        );

        return view('tags.index', compact('destinationposts', 'tag_data', 'tags_data', 'destinations_data', 'categories_data'));
    }

    public function postRedirect($slug)
    {

        $posts = DB::select("SELECT
            *
        FROM
            travel_posts_all
                LEFT JOIN
            (SELECT
                    u.user_id, p.meta_value AS avatar, us.user_nicename
                FROM
                    travel_users AS us
                    left join
                    travel_usermeta AS u on us.ID = u.user_id AND u.meta_key = 'travel_user_avatar'
                    left join
                    travel_postmeta AS p on u.meta_value = p.post_id AND p.meta_key = '_wp_attached_file') AS q
            ON travel_posts_all.author_id = q.user_id
        WHERE
            slug = '$slug'
        ORDER BY post_date DESC;");


        $category = $posts[0]->category_slug;
        $destino = $posts[0]->destination_slug;


        $array = [];
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        $apiresponse = json_decode(file_get_contents('https://admin.tribune.travel/wp-json/wp/v2/posts?slug=' . $slug));
        empty($apiresponse) || $apiresponse[0]->status != "publish" ? abort(404) : true;
        $img_id = isset($apiresponse[0]) ? $apiresponse[0]->featured_media : '';
        $imgdata = DB::select("SELECT * FROM tribunetravel_wp.travel_media WHERE ID = $img_id;");
        $imgdata = empty($imgdata) ? '' : $imgdata[0];
        $author_id = isset($apiresponse[0]) ? $apiresponse[0]->author : '';
        $authordata = DB::select("SELECT * FROM tribunetravel_wp.travel_author WHERE user_id = $author_id;");
        $authordata = empty($authordata) ? '' : $authordata[0];
        // dd($apiresponse);
        $category_name = "";
        $category_color = "";
        $portada_diarios = false;
        if ($apiresponse[0]->acf->portada_diarios) {
            $query = DB::select("SELECT guid FROM travel_posts WHERE ID = " . $apiresponse[0]->acf->portada_diarios);
            $portada_diarios = $query[0]->guid;
        }
        foreach ($categories_data as $c) {
            if ($c->term_id == $apiresponse[0]->categories[0]) {
                // dd($c);
                $category_name = $c->name;
                $category_color = $c->color;
            }
        }
        $destination_name = "";
        $destination_color = "";
        foreach ($destinations_data as $c) {
            if ($c->term_id == $apiresponse[0]->post_destinos[0]) {
                // dd($c);
                $destination_name = $c->name;
                $destination_color = $c->color;
            }
        }
        $post_ = [
            "slug" => $apiresponse[0]->slug,
            "date" => $apiresponse[0]->date,
            "id" => $apiresponse[0]->id,
            "category" => $category,
            "category_name" => $category_name,
            "category_color" => $category_color,
            "destination" => $destino,
            "destination_name" => $destination_name,
            "destination_color" => $destination_color,
            "title" => $apiresponse[0]->title->rendered,
            "subtitle" => $apiresponse[0]->acf->subtitle,
            "excerpt" => $apiresponse[0]->excerpt->rendered,
            "content" => $apiresponse[0]->content->rendered,
            "seo_title" => $apiresponse[0]->acf->titulo_seo,
            "seo_description" => $apiresponse[0]->acf->descripcion_seo,
            "canonical_url" => $apiresponse[0]->acf->url_canonica,
            "img" => $imgdata,
            "author" => $authordata,
            "portada_diarios" => $portada_diarios
        ];
        // dd($post_);
        $img_metadata = unserialize($post_['img']->img_data);
        $image = images((isset($img_metadata['s3']['formats']['webp'])) ? $img_metadata['s3']['formats']['webp'] : $img_metadata['file']);
        array_push($array, [
            "@type" => "author",
            "name" => $post_['author']->name,
            "url" => route('author', $post_['author']->user_nicename),
            "datePublished" => $post_['date'],
        ]);
        JsonLdMulti::setTitle($post_['seo_title']);
        JsonLdMulti::setDescription($post_['seo_description']);
        JsonLdMulti::setType('Article');
        JsonLdMulti::addImage($image);
        JsonLdMulti::addValue("author", $array);
        JsonLdMulti::addValue("headline", $post_['seo_title']);

        if (!JsonLdMulti::isEmpty()) {
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('WebPage');
            JsonLdMulti::setTitle('Page Article - ' . $post_['title']);
        }
        $id = $post_['id'];

        // dd($id);
        $more_posts = DB::select("SELECT * FROM travel_posts_category
                                    WHERE category_slug = '$category'
                                    AND id_post != $id
                                        ORDER BY post_date DESC
                                        LIMIT 3;");
        // dd($categories_data);
        $post_tags = DB::select("SELECT
                                    tags.name, tags.slug, tags.description, tags.color
                                FROM
                                    travel_tags AS tags,
                                    (SELECT
                                        `t`.`slug` AS `tag_slug`, `tr`.`object_id` AS `id_post`
                                    FROM
                                        `travel_terms` `t`
                                    JOIN `travel_term_taxonomy` `tt`
                                    JOIN `travel_term_relationships` `tr`
                                    WHERE
                                        `t`.`term_id` = `tt`.`term_id`
                                            AND `tt`.`taxonomy` = 'post_tag'
                                            AND `tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`) AS posts_tags
                                WHERE
                                    tags.slug = posts_tags.tag_slug
                                        AND id_post = $id;");
        // dd($post_);
        metadatos(
            isset($post_['seo_title']) ? $post_['seo_title'] : $post_['title'],
            isset($post_['seo_description']) ? $post_['seo_description'] : strip_tags($post_['excerpt']),
            isset($post_["img"]->ID) ? imgURL($post_["img"]->img_data) : config('constants.DEFAULT_IMAGE'),
            route('post', [$destino, $category, $post_['slug']]),
            (isset($post_['canonical_url']) && $post_['canonical_url'] != '') ? $post_['canonical_url'] : route('post', [$destino, $category, $post_['slug']])
        );
        $destination = $destino;
        // dd($portada_diarios);

        return view('posts.index', compact('post_', 'more_posts', 'category', 'destino', 'destinations_data', 'categories_data', 'post_tags', 'destination', 'portada_diarios'));
    }

    public function search(Request $request)
    {
        $bandera = true;
        $busqueda = $request->search;
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        if (!isset($busqueda)) {
            $bandera = false;
        }
        // dd($busqueda);
        $query = DB::select("SELECT * FROM travel_posts_destination WHERE title like '%$busqueda%' OR post_excerpt like '%$busqueda%' ORDER BY post_date DESC;");
        $posts = paginate($query, 20)->onEachSide(0);
        if (!isset($query[0])) {
            $bandera = false;
        }
        // dd($bandera);
        metadatos(
            config('constants.META_TITLE'),
            config('constants.META_DESCRIPTION'),
            config('constants.DEFAULT_IMAGE'),
            config('constants.META_URL'),
            config('constants.META_URL')
        );
        return view('search.index', compact('destinations_data', 'categories_data', 'busqueda', 'bandera', 'posts'));
    }

    public function flights($destination)
    {
        switch ($destination) {
            case 'cancun':
                $iframe = "https://www.avionio.com/widget/en/cun/arrivals";
                $description = 'Stay up to date with arrivals and departures of Cancun International Airport (CUN). Check the flight status, ETA and ETD of your trip to Cancun';
                break;
            case 'los-cabos':
                $iframe = "https://www.avionio.com/widget/en/sjd/arrivals";
                $description = 'Stay up to date with arrivals and departures of Los Cabos International Airport San Jose Cabo (SJD). Check flight status, ETA and ETD of your trip to Los Cabos.';
                break;

            default:
                $iframe = "https://www.avionio.com/widget/en/PVR/arrivals";
                $description = 'Stay up to date with arrivals and departures of Gustavo Diaz Ordaz International Airport Puerto Vallarta (PVR). Check flight status, ETA and ETD of your trip';
                break;
        }
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');

        $title_destination = DB::select("SELECT * FROM travel_destinations WHERE slug = '$destination';");

        $title = $title_destination[0]->name;

        metadatos(
            $title . ' | Tribune Travel',
            $description,
            config('constants.DEFAULT_IMAGE'),
            route('flights', $destination),
            route('flights', $destination)
        );
        return view('flights.index', compact('destinations_data', 'categories_data', 'iframe', 'destination'));
    }
}
