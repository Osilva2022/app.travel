<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostAll;
use App\Models\Taxonomy;
use App\Models\Tag;
use App\Models\Term;
use App\Models\User;
use App\Models\Events;
use App\Models\TermRelationship;
use App\Models\Attachment;
use Attribute;
use Illuminate\Contracts\View\View;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;
use URL as URLS;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Storage;
use App\Models\InstagramTokens;
use App\Helper\Helper;
use App\Mail\NewContact;
use Corcel\Model\Post as ModelPost;
use Corcel\Model\Taxonomy as ModelTaxonomy;
use Corcel\Model\Term as ModelTerm;
use App\Models\Divisa;
use App\Models\Weather;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;
use DateTime;

use App\Models\Contact;
use Illuminate\Support\Facades\Mail;


class PostsController extends Controller
{

    public function paginate($items, $perPage = 5, $page = null, $options = [])
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
        $x = ModelTaxonomy::find(4);
        $y = ModelPost::find(145);
        //dd($y->terms);
        // $pagination = 0;
        // if ($category == "reviews" || $category == "Reviews") {
        //     $ruta = 'reviews';
        //     $pagination = 8;
        // }
        // if ($category == "news" || $category == "News") {
        //     $ruta = 'news';
        //     $pagination = 12;
        // }
        $pagination = 8;
        if ($destination == '') {
            //$data = Post::taxonomy('category', $category)->status('publish')->latest();
            $post = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = '$category' ORDER BY post_date DESC");
        } else {
            $post = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = '$category' AND destination_slug = '$destination' ORDER BY post_date DESC");
        }

        $data = $this->paginate($post, $pagination)->onEachSide(0);
        return $data;
    }

    /**
     * Obtener las imagenes de una cuenta de instagram a travez de un api
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
     * Funcion para generar los metadatos en las paginas con SEO::generate()
     *
     */
    function metadatos($data, $type)
    {
        if ($type == 'home') {

            SEOTools::setTitle('Home Tribune Travel');
            SEOTools::setDescription('Noticias e ideas de viaje de los principales destinos de Puerto Vallarta, Riviera Nayarit, Cancún, Riviera Maya y Los Cabos en México. Hoteles, restaurantes.');
            SEOTools::opengraph()->setUrl('https://app.tribune.travel/');
            SEOTools::setCanonical('https://app.tribune.travel/');
            SEOTools::jsonLd()->addImage(URLS::to('/public/img/tribune-travel.png'));
            OpenGraph::addImage(URLS::to('/public/img/tribune-travel.png'), ['width' => 1200, 'height' => 630, 'type' => 'image/jpeg']);
            TwitterCard::setImage(URLS::to('/public/img/tribune-travel.png'));
        } elseif ($type == 'post') {

            SEOTools::setTitle($data->title);
            SEOTools::setDescription($data->post_excerpt);
            SEOTools::opengraph()->setUrl(URLS::to($data->url));
            SEOTools::setCanonical(URLS::to($data->url));
            SEOTools::jsonLd()->addImage(imgURL($data->image_data));
            OpenGraph::addImage(imgURL($data->image_data), ['width' => 1200, 'height' => 630, 'type' => 'image/jpeg']);
            TwitterCard::setImage(imgURL($data->image_data));
        }
    }

    /**
     * Funcion para mostrar un previews de un post desde Woordpress
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
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $this->metadatos($post, 'post');
        //dd($more_posts);

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
        $categories_data = $this->returndata('categories');

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
                                    td.image_data
                                FROM
                                    travel_guide td
                                    WHERE td.label = 22
                                ORDER BY td.destination_slug , td.category_slug;"); //Label '22' = VIP+
        //dd($things);
        $new = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'news' ORDER BY post_date DESC LIMIT 1");
        $news = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'news' ORDER BY post_date DESC LIMIT 5");
        $thing = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'things-to-do' ORDER BY post_date DESC LIMIT 1");
        $things = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'things-to-do' ORDER BY post_date DESC LIMIT 5");
        $blog = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'blogs' ORDER BY post_date DESC LIMIT 1");
        $blogs = DB::select("SELECT * FROM travel_posts_category WHERE category_slug = 'blogs' ORDER BY post_date DESC LIMIT 5");
        $event = DB::select("SELECT * FROM travel_events WHERE start_date >= current_date() ORDER BY start_date ASC LIMIT 4");
        $divisas_data = DB::select("SELECT * FROM travel_divisa WHERE country != 'USD'");
        $usd_data = DB::select("SELECT * FROM travel_divisa WHERE country = 'USD'");
        $usd = $usd_data[0];
        // dd($divisas_data);
        $gallery = $this->instagram();
        if (isset($gallery)) {
            $gallery = $gallery->data;
        } else {
            $gallery = false;
        }

        $static_gallery = $this->returndata('gallery');
        $gallery = $static_gallery;

        $this->metadatos('home', 'home');
        // $this->ApiWeather();
        $weather = $this->GetWeather();

        return view('layouts.index', compact('reviews', 'review', 'guide', 'news', 'new', 'things', 'thing', 'destinations', 'tags_data', 'event', 'categories_data', 'gallery', 'blog', 'blogs', 'divisas_data', 'usd', 'weather'));
    }

    /**
     * Funcion para mostrar el post final
     *
     */
    public function post($destino, $category, $slug): View
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
        // $post = $posts[0];        
        $post = (isset($posts[0])) ? $posts[0] : abort(404);

        $more_posts = DB::select("SELECT * FROM travel_posts_category
                                    WHERE category_slug = '$post->category_slug'
                                    AND id_post != $post->id_post
                                        ORDER BY post_date DESC
                                        LIMIT 3;");
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $this->metadatos($post, 'post');
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
        // dd($post_tag);

        return view('posts.index', compact('post', 'more_posts', 'category', 'destino', 'destinations_data', 'categories_data', 'post_tags'));
    }

    public function categories(Request $request, $category)
    {
        $destination = '';
        if (isset($request->destination)) {
            $destination = $request->destination;
        }
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');

        $firstpostcategory = $this->category($category, $destination)->first();
        $postscategory = $this->category($category, $destination);
        $category_data = DB::select("SELECT * FROM travel_categories WHERE slug = '$category';");
        (!isset($category_data[0])) ? abort(404) : '';
        // dd($destinations_data);

        return view('categories.index', compact('firstpostcategory', 'postscategory', 'category', 'categories_data', 'destinations_data', 'category_data', 'destination'));
    }

    public function destinations($destination, Request $request)
    {

        $posts = DB::select("SELECT * FROM travel_posts_destination WHERE destination_slug = '$destination' ORDER BY post_date DESC;");
        $destinationposts = $this->paginate($posts, 9)->onEachSide(0);
        $destination_data = DB::select("SELECT * FROM travel_destinations WHERE slug = '$destination';");
        (!isset($destination_data[0])) ? abort(404) : '';
        $categories_data = $this->returndata('categories');
        $destinations_data = $this->returndata('destinations');
        $tag_data = $this->returndata('tags');
        //dd($destinationposts[2]->terms);
        $review = true;
        if ($request->page && $request->page > 1) {
            $review = false;
        }
        return view('destinations.index', compact('destinationposts', 'tag_data', 'destinations_data', 'categories_data', 'destination_data', 'review', 'destination'));
    }

    /**
     * Funcion para mostrar los eventos proximos
     *
     */
    public function events(Request $request)
    {
        $query = '';
        $destination = '';
        if (isset($request->destination)) {
            $query = "AND destination_slug = '$request->destination'";
        }

        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $category = "events";
        $e = DB::select("SELECT * FROM travel_events WHERE start_date >= current_date() $query ORDER BY start_date ASC;");
        $events = $this->paginate($e, 5)->onEachSide(0);

        return view('categories.events', compact('events', 'categories_data', 'destinations_data', 'category', 'destination'));
    }

    /**
     * Funcion para mostrar los post por author
     *
     */
    public function author($author_id)
    {
        $author_info = DB::select("SELECT * FROM travel_users_info WHERE user_nicename = '$author_id';");
        $posts_info = DB::select("SELECT * FROM travel_posts_all WHERE user_nicename = '$author_id' ORDER BY post_date DESC;");
        //dd($posts_info);
        $author = $author_info[0];
        $no_posts = count($posts_info);
        $posts = $this->paginate($posts_info, 6)->onEachSide(0);
        $categories_data = $this->returndata('categories');
        $destinations_data = $this->returndata('destinations');
        $tag_data = $this->returndata('tags');

        return view('authors.index', compact('posts', 'tag_data', 'destinations_data', 'categories_data', 'author', 'no_posts'));
    }

    public function guide(Request $request)
    {
        // dd($request->all());
        $category = 'things-to-do';
        $destination = 'puerto-vallarta';
        if (isset($request->destination)) {
            $destination = $request->destination;
        }

        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $destination_data = DB::select("SELECT * FROM travel_destinations WHERE slug = '$destination'");
        $id_location = (isset($destination_data[0])) ? $destination_data[0]->term_id : abort(404);

        $things_categories = DB::select("SELECT * FROM (
                                            SELECT td.category_id,
                                            dc.name, dc.slug, dc.color as category_color, td.location, dc.image_data, dc.description
                                            ,ROW_NUMBER() over(partition by td.category_id,td.location ORDER BY td.location DESC) as orden
                                            FROM travel_directory as td
                                            inner join travel_directory_category as dc on td.category_id = dc.term_id
                                            ) t
                                            WHERE t.orden = 1
                                            AND location = '$id_location'
                                            ORDER BY location, category_id;");
        if (is_null($things_categories)) {
            // return abort(404);
            return redirect()->route('home');
        }

        return view('guide.index', compact('category', 'categories_data', 'destinations_data', 'destination_data', 'destination', 'things_categories', 'destination'));
    }

    public function guide_category($destination, $category, Request $request)
    {
        $categories_data = $this->returndata('categories');
        $things_category = DB::select("SELECT * FROM travel_directory_category WHERE slug = '$category';");
        $destinations_data = $this->returndata('destinations');
        $directory_category_data = DB::select("SELECT * FROM travel_directory_category WHERE slug= '$category';");
        $destination_data = DB::select("SELECT * FROM travel_destinations WHERE slug = '$destination'");
        $id_location = (isset($destination_data[0])) ? $destination_data[0]->term_id : abort(404);
        $id_category = (isset($directory_category_data[0])) ? $directory_category_data[0]->term_id : abort(404);
        $things_categories = DB::select("SELECT
                                                dc.term_id, dc.name as category, dc.slug as category_slug
                                            FROM
                                                travel_directory_category as dc,
                                            (SELECT * FROM (
                                            SELECT location, category_id
                                            ,ROW_NUMBER() over(partition by category_id, location ORDER BY location DESC) as orden
                                            FROM travel_directory
                                            ) t
                                            WHERE t.orden = 1
                                            AND location = $id_location) as q1 WHERE  dc.term_id = q1.category_id");
        $things_vip = DB::select("SELECT * FROM travel_directory WHERE location = '$id_location' AND category_id = '$id_category' AND label = 22;");

        $selectedtletter = '';
        if (isset($request->letter)) {
            $selectedtletter = $request->letter;
        }
        //dd($request);
        $array_abc = array_merge(range('A', 'Z'));
        if (!in_array($selectedtletter, $array_abc) && isset($request->letter)) { //No es abc...
            $selectedtletter = '*';
        }
        foreach ($array_abc as $key => $val) {
            $newval = "'$val'";
            $array_abc[$key] = $newval;
        }
        $abc = implode(",", $array_abc);
        $alphachar = DB::select("SELECT
                                    CASE
                                        WHEN letter not in($abc) THEN '*'
                                        ELSE letter
                                    END as letter_n
                                FROM
                                    travel_directory
                                WHERE
                                    location = '$id_location' AND category_id = '$id_category'
                                GROUP BY letter_n
                                ORDER BY letter_n ASC;");
        if (isset($request->letter)) {
            $things = DB::select("SELECT
                                    *
                                FROM
                                    (SELECT
                                        *,
                                        CASE
                                            WHEN letter not in($abc) THEN '*'
                                            ELSE letter
                                        END as letters
                                    FROM
                                        travel_directory
                                    WHERE
                                        location = '$id_location' AND category_id = '$id_category') as q1
                                WHERE
                                    letters = '$selectedtletter'
                                ORDER BY post_title ASC;");
        } else {
            $things = DB::select("SELECT
                                    *
                                    FROM
                                        travel_directory
                                    WHERE
                                        location = '$id_location' AND category_id = '$id_category'
                                ORDER BY post_title ASC;");
        }
        //dd($things);
        if (is_null($things)) {
            // return abort(404);
            return redirect()->route('home');
        }
        $gallery = $this->get_img_gallery($id_location, $id_category);
        $guide_tags = $this->GetTagsPosts($things);
        return view('guide.guide_category', compact('category', 'destination', 'categories_data', 'destinations_data', 'destination_data', 'things', 'gallery', 'things_vip', 'things_category', 'things_categories', 'alphachar', 'selectedtletter', 'guide_tags'));
    }

    public function GetTagsPosts($posts_list)
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

    public function get_img_gallery($destination, $category)
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

    public function ShowGuideItem(Request $request)
    {
        if (isset($request->id)) {
            $id = $request->id;

            $directory_item = DB::select("SELECT * FROM travel_directory WHERE ID = $id;");

            if (is_null($directory_item)) {
                // return abort(404);
                return redirect()->route('home');
            }
            $data = $directory_item[0];
            $gallery = [];
            $imgs = [];
            $post_gallery = unserialize($data->gallery);
            foreach ($post_gallery as $key) {
                $info = DB::select("SELECT
                                        meta_value AS img
                                    FROM
                                        tribunetravel_wp.travel_postmeta
                                    WHERE
                                        post_id = $key
                                            AND meta_key = '_wp_attached_file';");
                array_push($imgs, $info[0]->img);
            }
            $gallery["gallery-" . $data->ID] = $imgs;
            return view('guide.directory_item', compact('data', 'gallery'));
        }
        /* return $request->id; */
    }

    public function ShowDirectoryLetter(Request $request)
    {
        if (isset($request->letter)) {
            $letter = $request->letter;

            $selectedtletter = 'A';
            $things = DB::select("SELECT
                                    *
                                FROM
                                    (SELECT
                                        *, SUBSTRING(post_title, 1, 1) AS letter
                                    FROM
                                        travel_directory
                                    WHERE
                                        location = '$id_location' AND category_id = '$id_category') as q1
                                WHERE
                                    letter = '$selectedtletter'
                                ORDER BY post_title ASC;");
            $gallery = $this->get_img_gallery($id_location, $id_category);

            if (is_null($things)) {
                // return abort(404);
                return redirect()->route('home');
            }
            return view('guide.gallery', compact('data', 'gallery'));
        }
        /* return $request->id; */
    }

    public function cookies()
    {
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        return view('policies.cookies', compact('destinations_data', 'categories_data'));
    }

    public function privacy()
    {
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        return view('policies.privacy', compact('destinations_data', 'categories_data'));
    }

    public function sitemap()
    {
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $tags_data = $this->returndata('tags');
        return view('sitemap.index', compact('destinations_data', 'categories_data', 'tags_data'));
    }

    public function tags($tag)
    {
        $posts = DB::select("SELECT * FROM travel_posts_tag WHERE tag_slug = '$tag' ORDER BY post_date DESC;");
        $destinationposts = $this->paginate($posts, 9)->onEachSide(0);
        $tag_data = DB::select("SELECT * FROM travel_tags WHERE slug = '$tag';");
        $tags_data = DB::select("SELECT * FROM travel_tags;");
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        // dd("SELECT * FROM travel_tags WHERE slug = '$tag'");

        return view('tags.index', compact('destinationposts', 'tag_data', 'tags_data', 'destinations_data', 'categories_data'));
    }

    public function GetWeather()
    {
        $data = [];
        $locations_weather = DB::select("SELECT * FROM travel_weather;");
        foreach ($locations_weather as $weather) {
            $info = json_decode($weather->info);
            // date_default_timezone_set('Europe/Madrid');//Se pone esta zona horario, porque en esta nos la arroja la API
            foreach ($info->hour_hour as $w) {
                date_default_timezone_set($weather->timezone);
                $location_hour = date("Y-n-j G:00");
                $api_hour = $w->date . ' ' . $w->hour_data;
                //  dd($weather->timezone);
                if ($api_hour == $location_hour) { //Obtener el clima de la hora actual
                    $n = $weather->slug;
                    $icon = $this->GetIconWeather($w->icon);
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

    public function GetIconWeather($id)
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

    /* Funcion para obtener y guardar el clima */
    public function ApiWeather()
    {
        $clave = "axDaaqqzqaq72lm";
        $location_id = "54801"; //Vallarta
        $locations_weather = DB::select("SELECT * FROM travel_weather;");
        foreach ($locations_weather as $weather) {
            $location_id = $weather->idtravel_weather; //Vallarta
            $ContextOptionsWeather = array("ssl" => array("verify_peer" => false, "verify_peer_name" => false));
            $WeatherJson = file_get_contents('https://api.tutiempo.net/json/?lan=en&apid=' . $clave . '&lid=' . $location_id . '', false, stream_context_create($ContextOptionsWeather));
            $WeatherArray = json_decode($WeatherJson, true);
            Weather::where('idtravel_weather', $location_id)
                ->update(['info' => $WeatherJson]);
        }
        // dd($WeatherJson);
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

        // if (!isset($posts[0])) { //Fail and now send to home
        //     // dd($posts);
        //     dd('No');
        // }
        $post = $posts[0];
        $post = (isset($posts[0])) ? $posts[0] : abort(404);

        $more_posts = DB::select("SELECT * FROM travel_posts_category
                                    WHERE category_slug = '$post->category_slug'
                                    AND id_post != $post->id_post
                                        ORDER BY post_date DESC
                                        LIMIT 3;");
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $this->metadatos($post, 'post');
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
        $category = $post->category_slug;
        $destino = $post->destination_slug;

        return view('posts.index', compact('post', 'more_posts', 'category', 'destino', 'destinations_data', 'categories_data', 'post_tags'));
    }

    public function contact()
    {
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $subjects = DB::select('SELECT * FROM travel_contact_subject;');
        // dd($subjects);
        return view('contact.index', compact('destinations_data', 'categories_data', 'subjects'));
    }

    public function storeContact(Request $request)
    {
        request()->validate(Contact::$rules);
        $contact = Contact::create($request->all())->id;

        $query = "SELECT 
                        c.email,
                        c.firstname,
                        c.lastname,
                        c.zipcode,
                        c.message,
                        s.description AS subject
                    FROM
                        travel_contact_info AS c,
                        travel_contact_subject AS s
                    WHERE
                        c.id_subject = s.id_subject
                        AND c.id_contact = $contact";
        $new_contact = DB::select($query);

        // ->cc("axel.sanchez@cps.media")
        // ->cc("miriam.miramontes@cps.media")
        Mail::to("tribune@cps.media")
            ->send(new NewContact($new_contact[0]));

        return redirect()->route('contact')->with([
            'success' => 'Thank you for contacting us. We will get back to you soon.'
        ]);
    }
}
