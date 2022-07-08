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

    public function index(): View
    {
        $destinations_data = $this->color('post_destinos');
        $destinations_img = DB::select("SELECT t.term_id,t.name, tm.meta_value, p.guid as img FROM test_terms t 
                                        INNER JOIN test_termmeta tm ON t.term_id=tm.term_id
                                        INNER JOIN test_term_taxonomy ttt ON t.term_id=ttt.term_id
                                        left JOIN test_posts p ON tm.meta_value=p.ID
                                        WHERE tm.meta_key = 'imagen_destino'
                                        AND ttt.taxonomy = 'post_destinos'");
        $tags_data = DB::select("SELECT t.term_id,t.name FROM test_terms t , test_term_taxonomy ttt
                                WHERE t.term_id=ttt.term_id AND ttt.taxonomy = 'post_tag'");
        $categories_data = $this->returndata('category');

        $review = Post::taxonomy('category', 'Reviews')->latest()->first();
        $reviews = Post::taxonomy('category', 'Reviews')->latest()->limit(4)->get();
        $things = Post::taxonomy('category', 'Things to do')->latest()->get();        
        $new = Post::taxonomy('category', 'News')->latest()->first();
        $news = Post::taxonomy('category', 'News')->latest()->limit(4)->get(); 
        
        $events = DB::select("SELECT DISTINCT p.ID,p.post_title as title,p.post_name as slug,p.post_content as content,a.guid as image, pm.meta_value as start_event, pm2.meta_value as end_event, te.name as city
                            FROM test_posts as a
                            LEFT JOIN test_posts as p ON p.ID = a.post_parent AND a.post_type = 'attachment'
                            INNER JOIN test_postmeta pm ON pm.post_id = a.post_parent AND pm.meta_key = '_EventStartDate' 
                            INNER JOIN test_postmeta pm2 ON pm2.post_id = a.post_parent AND pm2.meta_key = '_EventEndDate'
                            INNER JOIN test_term_relationships tr ON tr.object_id = p.ID
                            INNER JOIN test_term_taxonomy tt ON tt.term_id = tr.term_taxonomy_id AND tt.taxonomy ='post_destinos'
                            INNER JOIN test_terms te ON te.term_id = tt.term_id
                            WHERE p.post_type = 'tribe_events' AND date(pm.meta_value) = current_date()
                            ORDER BY pm.meta_value DESC LIMIT 1");  
                            
        // dd($events);        

        return view('layouts.index', compact('reviews', 'review', 'things', 'news', 'new', 'destinations_data', 'tags_data', 'events', 'categories_data', 'destinations_img'));
    }

    public function post($destino, $category, $slug): View
    {
        $post = Post::slug($slug)->status('publish')->firstOrFail();
        $category = array_values($post->terms['category'])[0];
        $destinations_data = $this->color('post_destinos');
        // dd($post);

        return view('posts.index', compact('post', 'category', 'destino', 'destinations_data'));
    }

    public function category(string $category): View
    {
        if ($category == "reviews") {
            $ruta = 'reviews';
            $pagination = 8;
        }
        if ($category == "news") {
            $ruta = 'news';
            $pagination = 12;
        }
        $destinations_data = $this->color('post_destinos');
        $categories_data = $this->returndata('category');

        $firstpostcategory = Post::taxonomy('category', $category)->latest()->first();
        $postscategory = Post::taxonomy('category', $category)->latest()->paginate($pagination);
        //dd($postscategory);
        return view('categories.' . $ruta, compact('destinations_data', 'firstpostcategory', 'postscategory', 'category', 'categories_data'));
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


        $destinationposts = Post::taxonomy('post_destinos', $destination)->latest()->where('post_type', 'post')->paginate(3);
        //dd($destinationposts[0]->terms);
        $categories_data = $this->returndata('category');

        return view('destinations.index', compact('destinationposts', 'tag_data', 'category_data', 'destination_img', 'destinations_data', 'categories_data'));
    }
    

    public function destination_tag($destination, $category, $tag)
    {
        dd("destination_tag");
    }

    public function events()
    {       
        $events = DB::select("SELECT DISTINCT p.ID,p.post_title as title,p.post_name as slug,p.post_content as content,a.guid as image, pm.meta_value as start_event, pm2.meta_value as end_event, te.name as city
                            FROM test_posts as a
                            LEFT JOIN test_posts as p ON p.ID = a.post_parent AND a.post_type = 'attachment'
                            INNER JOIN test_postmeta pm ON pm.post_id = a.post_parent AND pm.meta_key = '_EventStartDate' 
                            INNER JOIN test_postmeta pm2 ON pm2.post_id = a.post_parent AND pm2.meta_key = '_EventEndDate'
                            INNER JOIN test_term_relationships tr ON tr.object_id = p.ID
                            INNER JOIN test_term_taxonomy tt ON tt.term_id = tr.term_taxonomy_id AND tt.taxonomy ='post_destinos'
                            INNER JOIN test_terms te ON te.term_id = tt.term_id
                            WHERE p.post_type = 'tribe_events' AND date(pm.meta_value) >= current_date()
                            ORDER BY pm.meta_value DESC");  
      
        
        dd($events);
    }
}
