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
use Illuminate\Support\Facades\Log;


class PostsController extends Controller
{
    function returndata($typedata)
    {
        switch ($typedata) {
            case 'category':
                $data = DB::select("SELECT t.term_id,t.name,t.slug, tm.meta_value FROM test_terms t 
                                    INNER JOIN test_termmeta tm ON t.term_id=tm.term_id
                                    INNER JOIN test_term_taxonomy ttt ON t.term_id=ttt.term_id
                                    WHERE tm.meta_key = 'cc_color' AND ttt.taxonomy = 'category'
                                    AND t.slug != 'sin-categoria'");
                break;

            default:
                break;
        }
        return $data;
    }

    function color($taxonomy)
    {

        $taxonomy_color = DB::select("SELECT t.term_id,t.name,t.slug, tm.meta_value FROM test_terms t 
                                        INNER JOIN test_termmeta tm ON t.term_id=tm.term_id
                                        INNER JOIN test_term_taxonomy ttt ON t.term_id=ttt.term_id
                                        WHERE tm.meta_key = 'cc_color' AND ttt.taxonomy = '$taxonomy'");

        return $taxonomy_color;
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

        $data = Post::taxonomy('category', $category)->taxonomy('post_destinos', "$destination")->status('publish')->latest()->paginate($pagination);

        if ($destination == '') {
            $data = Post::taxonomy('category', $category)->status('publish')->latest()->paginate($pagination);
        }
        return $data;
    }

    public function index(): View
    {

        $posts = DB::select("SELECT * FROM test_all_posts WHERE category_slug = 'reviews' ORDER BY post_date DESC LIMIT 1");
        //dd($posts[0]);
        $destinations = DB::select("SELECT * FROM test_destinations");
        $tags_data = DB::select("SELECT t.term_id,t.name FROM test_terms t , test_term_taxonomy ttt
                                WHERE t.term_id=ttt.term_id AND ttt.taxonomy = 'post_tag'");
        $categories_data = $this->returndata('category');

        $review = DB::select("SELECT * FROM test_all_posts WHERE category_slug = 'reviews' ORDER BY post_date DESC LIMIT 1");
        $reviews = DB::select("SELECT * FROM test_all_posts WHERE category_slug = 'reviews' ORDER BY post_date DESC LIMIT 4");
        $things = Post::taxonomy('category', 'Things to do')->latest()->get();
        $new = DB::select("SELECT * FROM test_all_posts WHERE category_slug = 'news' ORDER BY post_date DESC LIMIT 1");
        $news = DB::select("SELECT * FROM test_all_posts WHERE category_slug = 'news' ORDER BY post_date DESC LIMIT 4");
        $event = DB::select("SELECT * FROM test_events LIMIT 1");

        // dd($events);        

        return view('layouts.index', compact('reviews', 'review', 'things', 'news', 'new', 'destinations', 'tags_data', 'event', 'categories_data'));
    }

    public function post($destino, $category, $slug): View
    {
        $post = Post::slug($slug)->status('publish')->firstOrFail();
        $category = array_values($post->terms['category'])[0];
        $destinations_data = $this->color('post_destinos');
        $categories_data = $this->returndata('category');
        //dd($post->terms);

        return view('posts.index', compact('post', 'category', 'destino', 'destinations_data', 'categories_data'));
    }



    public function reviews(Request $request)
    {
        $category = 'reviews';
        $destination = '';
        if (isset($request->destination)) {
            $destination = $request->destination;
        }
        $destinations_data = $this->color('post_destinos');
        $categories_data = $this->returndata('category');
        $firstpostcategory = $this->category($category, $destination)->first();
        $postscategory = $this->category($category, $destination);

        // dd($categories_data); 
        return view('categories.reviews', compact('destinations_data', 'firstpostcategory', 'postscategory', 'category', 'categories_data'));
    }

    public function news(Request $request)
    {
        $category = 'news';
        $destination = '';
        if (isset($request->destination)) {
            $destination = $request->destination;
        }
        $destinations_data = $this->color('post_destinos');
        $categories_data = $this->returndata('category');
        $firstpostcategory = $this->category($category, $destination)->first();
        $postscategory = $this->category($category, $destination);
        return view('categories.news', compact('destinations_data', 'firstpostcategory', 'postscategory', 'category', 'categories_data'));
    }

    public function destinations($destination)
    {
        $tag_data = $this->color('post_tag');
        $destinations_data = $this->color('post_destinos');

        $category_data = DB::select("SELECT t.term_id,t.name,t.slug, tm.meta_value FROM test_terms t 
                                        INNER JOIN test_termmeta tm ON t.term_id=tm.term_id
                                        INNER JOIN test_term_taxonomy ttt ON t.term_id=ttt.term_id
                                        WHERE tm.meta_key = 'cc_color' AND ttt.taxonomy = 'category'
                                        AND t.slug != 'sin-categoria'");

        $destination_img = DB::select("SELECT t.term_id,t.name, tm.meta_value, p.guid as img FROM test_terms t 
                                        INNER JOIN test_termmeta tm ON t.term_id=tm.term_id
                                        INNER JOIN test_term_taxonomy ttt ON t.term_id=ttt.term_id
                                        left JOIN test_posts p ON tm.meta_value=p.ID
                                        WHERE tm.meta_key = 'imagen_destino'
                                        AND ttt.taxonomy = 'post_destinos'
                                        AND t.slug = '$destination'");


        $destinationposts = Post::taxonomy('post_destinos', $destination)->status('publish')->latest()->where('post_type', 'post')->paginate(3);
        //dd($destination_img);
        $categories_data = $this->returndata('category');

        return view('destinations.index', compact('destinationposts', 'tag_data', 'category_data', 'destination_img', 'destinations_data', 'categories_data'));
    }


    public function destination_tag($destination, $category, $tag)
    {
        dd("destination_tag");
    }

    public function events(Request $request)
    {
        // dd($request->all());    
        $query = '';
        if (isset($request->destination)) {
            $query = "AND te.slug = '$request->destination'";
        }
        // dd($query); 


        $destinations_data = $this->color('post_destinos');
        $categories_data = $this->returndata('category');
        $category = 'events';

        $events = DB::select("SELECT p.ID,p.post_title as title,p.post_name as slug,p.post_content as content,a.guid as image, 
        CONVERT(pm.meta_value, datetime) as start_event, pm2.meta_value as end_event, te.name as city
                            FROM test_posts as a
                            LEFT JOIN test_posts as p ON p.ID = a.post_parent AND a.post_type = 'attachment'
                            INNER JOIN test_postmeta pm ON pm.post_id = a.post_parent AND pm.meta_key = '_EventStartDate' 
                            INNER JOIN test_postmeta pm2 ON pm2.post_id = a.post_parent AND pm2.meta_key = '_EventEndDate'
                            INNER JOIN test_term_relationships tr ON tr.object_id = p.ID
                            INNER JOIN test_term_taxonomy tt ON tt.term_id = tr.term_taxonomy_id AND tt.taxonomy ='post_destinos'
                            INNER JOIN test_terms te ON te.term_id = tt.term_id
                            WHERE p.post_type = 'tribe_events' AND date(pm.meta_value) >= current_date() $query
                            ORDER BY start_event, a.post_date DESC");
        $events_categories = DB::select("SELECT t.term_id,t.name,t.slug, tm.meta_value FROM test_terms t 
                                            INNER JOIN test_termmeta tm ON t.term_id=tm.term_id
                                            INNER JOIN test_term_taxonomy ttt ON t.term_id=ttt.term_id
                                            WHERE tm.meta_key = 'cc_color' AND ttt.taxonomy = 'tribe_events_cat'");

        return view('categories.events', compact('events', 'categories_data', 'destinations_data', 'category'));
    }

    public function things(Request $request)
    {
        $destinations_data = $this->color('post_destinos');
        $categories_data = $this->returndata('category');
        $things = '';


        return view('things_to_do.index', compact('things', 'categories_data', 'destinations_data'));
    }
}
