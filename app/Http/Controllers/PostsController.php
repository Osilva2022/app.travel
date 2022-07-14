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
use Illuminate\Support\Facades\Log;


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
                $data = DB::select("SELECT * FROM tribunet_test.test_categories WHERE slug != 'sin-categoria'");
                break;
            case 'destinations':
                $data = DB::select("SELECT * FROM tribunet_test.test_destinations;");
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
            $pagination = 2;
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

    public function index(): View
    {

        //$posts = DB::select("SELECT * FROM test_all_posts WHERE category_slug = '$category' ORDER BY post_date DESC");

        //$page1 = new Paginator($posts, 10);
        // dd($page1);
        $destinations = DB::select("SELECT * FROM test_destinations");
        $tags_data = DB::select("SELECT t.term_id,t.name FROM test_terms t , test_term_taxonomy ttt
                                WHERE t.term_id=ttt.term_id AND ttt.taxonomy = 'post_tag'");
        $categories_data = $this->returndata('categories');

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
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
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
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $firstpostcategory = $this->category($category, $destination)->first();
        $postscategory = $this->category($category, $destination);

        //dd($postscategory); 
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
        $posts = DB::select("SELECT * FROM test_all_posts WHERE destination_slug = '$destination';");
        $destinationposts = $this->paginate($posts, 2);
        $destination_data = DB::select("SELECT * FROM test_destinations WHERE slug = '$destination'");
        $categories_data = $this->returndata('categories');
        $destinations_data = $this->returndata('destinations');
        $tag_data = $this->color('post_tag');
        //dd($destinationposts);

        return view('destinations.index', compact('destinationposts', 'tag_data', 'destinations_data', 'categories_data', 'destination_data'));
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


        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
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
        $destinations_data = $this->returndata('destinations');
        $categories_data = $this->returndata('categories');
        $things = '';
        return view('things_to_do.index', compact('things', 'categories_data', 'destinations_data'));
    }
}
