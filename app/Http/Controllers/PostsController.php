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
        $events = Post::taxonomy('category', 'Events')->latest()->get();
        $new = Post::taxonomy('category', 'News')->latest()->first();
        $news = Post::taxonomy('category', 'News')->latest()->limit(4)->get();
        // dd($events->meta);        

        return view('layouts.index', compact('reviews', 'review', 'things', 'events', 'news', 'new', 'destinations_data', 'tags_data', 'destinations_img', 'categories_data'));
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

    public function destination_category($destination, $category)
    {
        dd("destination_category");
    }

    public function destination_tag($destination, $category, $tag)
    {
        dd("destination_tag");
    }

    public function events()
    {
        $events = Post::published()->where('post_type', 'tribe_events')->first();

        dd($events->meta);
        foreach ($events->meta as $meta) {
            var_dump($meta->meta_key['_EventStartDate']);
        }
        dd($events->meta);
    }
}
