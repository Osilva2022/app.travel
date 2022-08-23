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
use URL;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Storage;
use App\Models\InstagramTokens;
use App\Helper\Helper;

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
            default:
                break;
        }
        return $data;
    }

    function category($category, $destination)
    {
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
        $post = DB::select("SELECT * FROM travel_all_posts WHERE category_slug = '$category' AND destination_slug = '$destination' ORDER BY post_date DESC");
        if ($destination == '') {
            //$data = Post::taxonomy('category', $category)->status('publish')->latest();
            $post = DB::select("SELECT * FROM travel_all_posts WHERE category_slug = '$category' ORDER BY post_date DESC");
        }
        $data = $this->paginate($post, $pagination)->onEachSide(0);
        //dd($data); 
        return $data;
    }

    function instagram()
    {
        $instagramtoken = InstagramTokens::find(1);
        $token = $instagramtoken->token;

        $instagram = new InstagramBasicDisplay($token);
        $instagram->setAccessToken($token);
        // $t = $instagram->getAccessToken();
        // $tt = $instagram->refreshToken($token,true);        
        $media = $instagram->getUserMedia('me', 6);
        // dd($media);
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

            SEOTools::setTitle($data->title);
            SEOTools::setDescription($data->post_excerpt);
            SEOTools::opengraph()->setUrl(URL::to($data->url));
            SEOTools::setCanonical(URL::to($data->url));
            SEOTools::jsonLd()->addImage($data->image);
            OpenGraph::addImage($data->image, ['width' => 1200, 'height' => 630, 'type' => 'image/jpeg']);
            TwitterCard::setImage($data->image);
        }
    }

    function preview($id)
    {
        $posts = DB::select("SELECT 
            *
        FROM
            travel_all_posts
                LEFT JOIN
            (SELECT 
                u.user_id,
                    p.meta_value AS avatar
            FROM
                travel_usermeta AS u, travel_postmeta AS p
            WHERE
                u.meta_key = 'travel_user_avatar'
                    AND u.meta_value = p.post_id
                    AND p.meta_key = '_wp_attached_file') AS q ON travel_all_posts.author_id = q.user_id
        WHERE
            id_post = $id
        ORDER BY post_date DESC;");

        $post = $posts[0];
        $category = $post->category_slug;
        $destino = $post->destination_slug;
        $more_posts = DB::select("SELECT * FROM travel_all_posts 
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

        $review = DB::select("SELECT * FROM travel_all_posts WHERE category_slug = 'reviews' ORDER BY post_date DESC LIMIT 1");
        $reviews = DB::select("SELECT * FROM travel_all_posts WHERE category_slug = 'reviews' ORDER BY post_date DESC LIMIT 5");
        $things = DB::select("SELECT
                                    td.ID,
                                    td.category_id,
                                    td.category,
                                    td.category_slug,
                                    td.destination,
                                    td.destination_slug,
                                    td.post_title,
                                    td.label,
                                    td.image,
                                    td.image_data
                                FROM
                                    travel_directory as td 
                                    WHERE td.label = 22
                                ORDER BY td.destination_slug , td.category_id;"); //Label '22' = VIP+
        //dd($things);
        $new = DB::select("SELECT * FROM travel_all_posts WHERE category_slug = 'news' ORDER BY post_date DESC LIMIT 1");
        $news = DB::select("SELECT * FROM travel_all_posts WHERE category_slug = 'news' ORDER BY post_date DESC LIMIT 5");
        $event = DB::select("SELECT * FROM travel_events WHERE start_date >= current_date() ORDER BY start_date ASC LIMIT 4");

        $gallery = $this->instagram();
        if (isset($gallery)) {
            $gallery = $gallery->data;
        } else {
            $gallery = false;
        }

        $this->metadatos('home', 'home');


        return view('layouts.index', compact('reviews', 'review', 'things', 'news', 'new', 'destinations', 'tags_data', 'event', 'categories_data', 'gallery'));
    }

    public function post($destino, $category, $slug): View
    {
        $posts = DB::select("SELECT 
                                    *
                                FROM
                                    travel_all_posts
                                        LEFT JOIN
                                    (SELECT 
                                        u.user_id, p.meta_value AS avatar, us.user_nicename
                                    FROM
                                        travel_usermeta AS u,
                                        travel_users AS us,
                                        travel_postmeta AS p
                                    WHERE
                                        u.meta_key = 'travel_user_avatar'
                                            AND u.meta_value = p.post_id
                                            AND us.ID = u.user_id
                                            AND p.meta_key = '_wp_attached_file') AS q ON travel_all_posts.author_id = q.user_id
                                WHERE
                                    slug = '$slug'
                                ORDER BY post_date DESC;");
        $post = $posts[0];

        $more_posts = DB::select("SELECT * FROM travel_all_posts 
                                    WHERE category_slug = '$post->category_slug'
                                    AND id_post != $post->id_post
                                        ORDER BY post_date DESC
                                        LIMIT 3;");
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $this->metadatos($post, 'post');
        //dd($post->content);

        return view('posts.index', compact('post', 'more_posts', 'category', 'destino', 'destinations_data', 'categories_data'));
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

        // dd($firstpostcategory); 
        return view('categories.index', compact('firstpostcategory', 'postscategory', 'category', 'categories_data', 'destinations_data'));
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
        $posts = DB::select("SELECT * FROM travel_all_posts WHERE destination_slug = '$destination' ORDER BY post_date DESC;");
        $destinationposts = $this->paginate($posts, 9)->onEachSide(0);
        $destination_data = DB::select("SELECT * FROM travel_destinations WHERE slug = '$destination';");
        $categories_data = $this->returndata('categories');
        $destinations_data = $this->returndata('destinations');
        $tag_data = $this->returndata('tags');
        //dd($destination_data);

        return view('destinations.index', compact('destinationposts', 'tag_data', 'destinations_data', 'categories_data', 'destination_data'));
    }


    public function events(Request $request)
    {
        $query = '';
        if (isset($request->destination)) {
            $query = "AND destination_slug = '$request->destination'";
        }
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $category = "events";
        $e = DB::select("SELECT * FROM travel_events WHERE start_date >= current_date() $query ORDER BY start_date ASC;");
        $events = $this->paginate($e, 5)->onEachSide(0);

        return view('categories.events', compact('events', 'categories_data', 'destinations_data', 'category'));
    }

    public function author($author_id)
    {

        $posts_info = DB::select("SELECT * FROM travel_all_posts WHERE user_nicename = '$author_id' ORDER BY post_date DESC;");
        //dd($posts_info);
        $author_info = DB::select("SELECT * FROM travel_users_info WHERE user_nicename = '$author_id';");
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
        $category = 'things-to-do';
        $destination = 'puerto-vallarta';
        if (isset($request->destination)) {
            $destination = $request->destination;
        }
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $destination_data = DB::select("SELECT * FROM travel_destinations WHERE slug = '$destination'");

        $things_categories = DB::select("SELECT * FROM (
                                            SELECT td.category_id, td.category,td.category_slug, 
                                            dc.name, dc.slug, dc.color as category_color, td.destination_slug, td.post_title, td.label, dc.image, dc.description
                                            ,ROW_NUMBER() over(partition by td.category_id,td.location ORDER BY td.location DESC) as orden
                                            FROM travel_directory as td
                                            inner join travel_directory_category as dc on td.category_id = dc.term_id
                                            ) t
                                            WHERE t.orden = 1
                                            AND destination_slug = '$destination'
                                            ORDER BY destination_slug, category_id;");

        return view('guide.index', compact('category', 'categories_data', 'destinations_data', 'destination_data', 'destination', 'things_categories'));
    }

    public function guide_category($destination, $category, Request $request)
    {
        $categories_data = $this->returndata('categories');
        $things_category = DB::select("SELECT * FROM travel_directory_category WHERE slug = '$category';");
        $destinations_data = $this->returndata('destinations');
        $directory_category_data = DB::select("SELECT * FROM travel_directory_category WHERE slug= '$category';");
        $destination_data = DB::select("SELECT * FROM travel_destinations WHERE slug = '$destination'");
        $id_location = $destination_data[0]->term_id;
        $id_category = $directory_category_data[0]->term_id;
        $things_categories = DB::select("SELECT 
                                                dc.term_id, dc.name as category, dc.slug as category_slug
                                            FROM
                                                travel_directory_category as dc,
                                            (SELECT * FROM (
                                            SELECT location, category, category_id
                                            ,ROW_NUMBER() over(partition by category, location ORDER BY location DESC) as orden
                                            FROM travel_directory
                                            ) t
                                            WHERE t.orden = 1
                                            AND location = $id_location) as q1 WHERE  dc.term_id = q1.category_id");
        $posts = DB::select("SELECT * FROM travel_directory WHERE location = '$id_location' AND category_id = '$id_category' Order by post_title asc;");
        $things = $this->paginate($posts, 5)->onEachSide(0);
        $things_vip = DB::select("SELECT * FROM travel_directory WHERE location = '$id_location' AND category_id = '$id_category' AND label = 22;");

        $gallery = $this->get_img_gallery($id_location, $id_category);
        //dd($things->links());
        return view('guide.guide_category', compact('category', 'destination', 'categories_data', 'destinations_data', 'destination_data', 'things', 'gallery', 'things_vip', 'things_category', 'things_categories'));
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
}
