<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Taxonomy;
use App\Models\Tag;
use App\Models\TermRelationship;
use App\Models\Attachment;
use Illuminate\Contracts\View\View;
use DB;

class PostsController extends Controller
{

    public function index(): View
    {
        $destinations_data = DB::select("SELECT t.term_id,t.name,t.slug, tm.meta_value FROM test_terms t 
                                        INNER JOIN test_termmeta tm ON t.term_id=tm.term_id
                                        INNER JOIN test_term_taxonomy ttt ON t.term_id=ttt.term_id
                                        WHERE tm.meta_key = 'cc_color' AND ttt.taxonomy = 'post_destinos'");

        $tags_data = DB::select("SELECT t.term_id,t.name FROM test_terms t , test_term_taxonomy ttt
<<<<<<< HEAD
                                WHERE t.term_id=ttt.term_id AND ttt.taxonomy = 'post_tag'");

        //$posts = Taxonomy::all();        
=======
                                WHERE t.term_id=ttt.term_id AND ttt.taxonomy = 'post_tag'");               
>>>>>>> 95c4ff867f5188f5351c97581fc37754d7bc01be

        $review = Post::taxonomy('category', 'Reviews')->latest()->first();
        $reviews = Post::taxonomy('category', 'Reviews')->latest()->limit(4)->get();
        $things = Post::taxonomy('category', 'Things to do')->latest()->get();
        $events = Post::taxonomy('category', 'Events')->latest()->get();
        $new = Post::taxonomy('category', 'News')->latest()->first();
        $news = Post::taxonomy('category', 'News')->latest()->get();
        
        // dd(array_values($review->terms['post_destinos'])[0]);
        $news = Post::taxonomy('category', 'News')->latest()->limit(4)->get();

        // dd($review->post_destinos);

        return view('layouts.index', compact('reviews', 'review', 'things', 'events', 'news', 'new', 'destinations_data', 'tags_data'));
    }

    public function post(string $slug): View
    {
        $post = Post::slug($slug)->status('publish')->firstOrFail();
        $category = array_values($post->terms['category']);
        $category = $category[0];
        //dd($post);
        return view('posts.index', compact('post', 'category'));
    }

    public function category(string $category): View
    {
        if ($category == "Reviews") {
            $ruta = 'reviews';
            $pagination = 8;
        }
        if ($category == "News") {
            $ruta = 'news';
            $pagination = 12;
        }
        $destinations_data = DB::select("SELECT t.term_id,t.name, tm.meta_value FROM test_terms t 
                                            INNER JOIN test_termmeta tm ON t.term_id=tm.term_id
                                            INNER JOIN test_term_taxonomy ttt ON t.term_id=ttt.term_id
                                            WHERE tm.meta_key = 'cc_color'
                                            AND ttt.taxonomy = 'post_destinos'");

        $firstpostcategory = Post::taxonomy('category', $category)->latest()->first();
        $postscategory = Post::taxonomy('category', $category)->latest()->paginate($pagination);
        // dd($category);
        return view('categories.' . $ruta, compact('destinations_data', 'firstpostcategory', 'postscategory', 'category'));
    }

    public function destiny($destiny)
    {
        dd($destiny);
    }
}
