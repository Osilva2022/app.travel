<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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
use URL;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    function wp_get_custom_css($stylesheet = '')
    {
        $css = '';

        if (empty($stylesheet)) {
            $stylesheet = get_stylesheet();
        }

        $post = wp_get_custom_css_post($stylesheet);
        if ($post) {
            $css = $post->post_content;
        }

        /**
         * Filters the custom CSS output into the head element.
         *
         * @since 4.7.0
         *
         * @param string $css        CSS pulled in from the Custom CSS post type.
         * @param string $stylesheet The theme stylesheet name.
         */
        $css = apply_filters('wp_get_custom_css', $css, $stylesheet);

        return $css;
    }

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
                $data = DB::select("SELECT * FROM tribunet_test.test_categories WHERE slug != 'sin-categoria'");
                break;
            case 'destinations':
                $data = DB::select("SELECT * FROM tribunet_test.test_destinations;");
                break;
            case 'tags':
                $data = DB::select("SELECT t.term_id,t.name,t.slug, tm.meta_value FROM test_terms t 
                                INNER JOIN test_termmeta tm ON t.term_id=tm.term_id
                                INNER JOIN test_term_taxonomy ttt ON t.term_id=ttt.term_id
                                WHERE tm.meta_key = 'cc_color' AND ttt.taxonomy = 'post_tag'");
                break;
            default:
                break;
        }
        return $data;
    }

    function category($category, $destination)
    {
        $pagination = 0;
        if ($category == "reviews" || $category == "Reviews") {
            $ruta = 'reviews';
            $pagination = 8;
        }
        if ($category == "news" || $category == "News") {
            $ruta = 'news';
            $pagination = 12;
        }

        //$data = Post::taxonomy('category', $category)->taxonomy('post_destinos', "$destination")->status('publish')->latest()->paginate($pagination);
        $post = DB::select("SELECT * FROM test_all_posts WHERE category_slug = '$category' AND destination_slug = '$destination' ORDER BY post_date DESC");
        if ($destination == '') {
            //$data = Post::taxonomy('category', $category)->status('publish')->latest();
            $post = DB::select("SELECT * FROM test_all_posts WHERE category_slug = '$category' ORDER BY post_date DESC");
        }
        $data = $this->paginate($post, $pagination);
        //dd($data);
        return $data;
    }

    function instagram()
    {
        $instagram = new InstagramBasicDisplay([
            'appId' => env('INSTAGRAM_APP_ID'),
            'appSecret' => env('INSTAGRAM_SECRET_KEY'),
            'redirectUri' => env('INSTAGRAM_VALID_OAUTH_URI')
        ]);

        // echo "<a href='{$instagram->getLoginUrl()}'>Login with Instagram</a>";
        // $code = 'AQCQs9DL1DS4mV7XAY_RhMall-FpDnfIuUKl9tJbAJk6fUsYFEyomP_xv5RUUs1AZQPEOR_pbemVdWCiNhMw8op65YH3XoAAEqHwbgBn7E5xYbfXrnj6RS203qQnFQpMVLOiIcDdEaXpr7qKeZLCmSC5VfIn6ugpJIcApGzxuO0mXH_n7eGpVdemP-GTBUzOkk_BfjY69gDxcBiscIKvGBAlNswQiplecGkwEq6xIgnjCQ';
        // $instagram = new InstagramBasicDisplay($token);

        // $token = $instagram->getOAuthToken($code, true);
        // $token = $instagram->getLongLivedToken($token, true);       

        // token is
        $token = 'IGQVJXZAnloZAXl1MkRWRzZAHbF9YNzJsMDdvWXVCZAk1Db1ZAqUWlfY3pOc25vcGlJeV9NUUVaT2t1N1hUQTJXRGVXRHFjbHhodUMwbWRIVE9yS093OGc2ZA1RmNWVsaXEyZATE0b0pvaVB3';
        $instagram->setAccessToken($token);

        $media = $instagram->getUserMedia('me', 6);

        return $media;
    }

    function metadatos($data, $type)
    {
        if ($type == 'home') {

            SEOTools::setTitle('Home Tribune Travel');
            SEOTools::setDescription('Noticias e ideas de viaje de los principales destinos de Puerto Vallarta, Riviera Nayarit, Cancún, Riviera Maya y Los Cabos en México. Hoteles, restaurantes.');
            SEOTools::opengraph()->setUrl('https://app.tribune.travel/');
            SEOTools::setCanonical('https://app.tribune.travel/');
            SEOTools::jsonLd()->addImage(URL::to('/public/img/tribune-travel.png'));
            OpenGraph::addImage(URL::to('/public/img/tribune-travel.png'), ['width' => 1200, 'height' => 630, 'type' => 'image/jpeg']);
            TwitterCard::setImage(URL::to('/public/img/tribune-travel.png'));
        } elseif ($type == 'post') {
            // dd($data);
            SEOTools::setTitle($data->title);
            SEOTools::setDescription($data->post_excerpt);
            SEOTools::opengraph()->setUrl(URL::to($data->url));
            SEOTools::setCanonical(URL::to($data->url));
            SEOTools::jsonLd()->addImage($data->image);
            OpenGraph::addImage($data->image, ['width' => 1200, 'height' => 630, 'type' => 'image/jpeg']);
            TwitterCard::setImage($data->image);
        }
    }

    public function index(): View
    {
        $destinations = DB::select("SELECT * FROM test_destinations");
        $tags_data = DB::select("SELECT t.term_id,t.name FROM test_terms t , test_term_taxonomy ttt
                                WHERE t.term_id=ttt.term_id AND ttt.taxonomy = 'post_tag'");
        $categories_data = $this->returndata('categories');

        $review = DB::select("SELECT * FROM test_all_posts WHERE category_slug = 'reviews' ORDER BY post_date DESC LIMIT 1");
        $reviews = DB::select("SELECT * FROM test_all_posts WHERE category_slug = 'reviews' ORDER BY post_date DESC LIMIT 5");
        //$things = Post::taxonomy('category', 'Things to do')->latest()->get();
        $things = DB::select("SELECT * FROM (
                                SELECT category_slug,category, category_color, destination_slug, title, image
                                ,ROW_NUMBER() over(partition by category_slug,destination_slug ORDER BY destination_slug DESC) as orden
                                FROM test_things_to_do
                                ) t
                                WHERE t.orden = 1
                                ORDER BY destination_slug, category;");
        //dd($things);
        $new = DB::select("SELECT * FROM test_all_posts WHERE category_slug = 'news' ORDER BY post_date DESC LIMIT 1");
        $news = DB::select("SELECT * FROM test_all_posts WHERE category_slug = 'news' ORDER BY post_date DESC LIMIT 5");
        $event = DB::select("SELECT * FROM test_events WHERE start_date >= current_date() ORDER BY start_date ASC LIMIT 4");
        $gallery = $this->instagram();
        $gallery = $gallery->data;        

        // dd($gallery);        

        // dd($event);

        $this->metadatos('home', 'home');
        // dd($events);        

        return view('layouts.index', compact('reviews', 'review', 'things', 'news', 'new', 'destinations', 'tags_data', 'event', 'categories_data', 'gallery'));
    }

    public function post($destino, $category, $slug): View
    {
        $posts = DB::select("SELECT * FROM test_all_posts WHERE slug = '$slug' ORDER BY post_date DESC;");
        $post = $posts[0];
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $this->metadatos($post, 'post');

        return view('posts.index', compact('post', 'category', 'destino', 'destinations_data', 'categories_data'));
    }

    public function reviews(Request $request)
    {
        $category = 'reviews';
        $destination = '';
        if (isset($request->destination)) {
            $destination = $request->destination;
        }
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $firstpostcategory = $this->category($category, $destination)->first();
        $postscategory = $this->category($category, $destination);

        //dd($firstpostcategory); 
        return view('categories.reviews', compact('firstpostcategory', 'postscategory', 'category', 'categories_data', 'destinations_data'));
    }

    public function news(Request $request)
    {
        $category = 'news';
        $destination = '';
        if (isset($request->destination)) {
            $destination = $request->destination;
        }
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $firstpostcategory = $this->category($category, $destination)->first();
        $postscategory = $this->category($category, $destination);
        return view('categories.news', compact('destinations_data', 'firstpostcategory', 'postscategory', 'category', 'categories_data'));
    }

    public function destinations($destination)
    {

        //$destinationposts = Post::taxonomy('post_destinos', $destination)->status('publish')->latest()->where('post_type', 'post')->paginate(3);
        $posts = DB::select("SELECT * FROM test_all_posts WHERE destination_slug = '$destination' ORDER BY post_date DESC;");
        $destinationposts = $this->paginate($posts, 9);
        $destination_data = DB::select("SELECT * FROM test_destinations WHERE slug = '$destination';");
        $categories_data = $this->returndata('categories');
        $destinations_data = $this->returndata('destinations');
        $tag_data = $this->returndata('tags');
        //dd($destination_data);

        return view('destinations.index', compact('destinationposts', 'tag_data', 'destinations_data', 'categories_data', 'destination_data'));
    }

    public $amount = 1;

    public function events(Request $request)
    {
        $query = '';
        if (isset($request->destination)) {
            $query = "AND destination_slug = '$request->destination'";
        }
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $category = "events";
        $e = DB::select("SELECT * FROM test_events WHERE start_date >= current_date() $query ORDER BY start_date ASC;");
        $events = $this->paginate($e, 1);
        //$events = DB::table('test_events')->take($this->amount)->get();

        return view('categories.events', compact('events', 'categories_data', 'destinations_data', 'category'));
    }

    public function things(Request $request)
    {
        $category = 'things-to-do';
        $destination = 'puerto-vallarta';
        if (isset($request->destination)) {
            $destination = $request->destination;
        }
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $destination_data = DB::select("SELECT * FROM test_destinations WHERE slug = '$destination'");
        $things_categories = DB::select("SELECT * FROM (
            SELECT tt.category_slug,tt.category, tt.category_color, tt.destination_slug, tt.title, ttc.image, ttc.description
            ,ROW_NUMBER() over(partition by tt.category_slug,tt.destination_slug ORDER BY tt.destination_slug DESC) as orden
            FROM test_things_to_do as tt
            inner join test_things_categories as ttc on tt.category_slug = ttc.slug
            ) t
            WHERE t.orden = 1
            AND destination_slug = '$destination'
        ");
        //dd($things_categories);

        return view('things_to_do.index', compact('category', 'categories_data', 'destinations_data', 'destination_data', 'destination', 'things_categories'));
    }

    public function things_category($destination, $category)
    {
        $destination_data = DB::select("SELECT * FROM test_destinations WHERE slug = '$destination'");
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $things_category = DB::select("SELECT * FROM test_things_categories WHERE slug = '$category';");
        $things_categories = DB::select("SELECT * FROM (
            SELECT category_slug,category, category_color, destination_slug
            ,ROW_NUMBER() over(partition by category_slug,destination_slug ORDER BY destination_slug DESC) as orden
            FROM test_things_to_do
            ) t
            WHERE t.orden = 1
            AND destination_slug = '$destination'
        ");
        //$posts = DB::select("SELECT * FROM test_things_to_do WHERE destination_slug = '$destination' AND category_slug = '$category';");
        $posts = DB::select("SELECT 
                                    *, IF(orden > 0, orden, 10) AS o
                                FROM
                                    test_things_to_do
                                WHERE destination_slug = '$destination' AND category_slug = '$category'
                                ORDER BY CAST(o AS DECIMAL) ASC, post_date desc;");
        $things = $this->paginate($posts, 4);
        //dd($things_category);
        return view('things_to_do.things_category', compact('category', 'destination', 'categories_data', 'destinations_data', 'destination_data', 'things', 'things_category', 'things_categories'));
    }
}
