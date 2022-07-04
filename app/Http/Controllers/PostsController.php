<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
// use Corcel\Post;
use Illuminate\Contracts\View\View;
use DB;

class PostsController extends Controller
{

    public function index(): View
    {
        $destinations_data = DB::select("SELECT t.term_id,t.name, tm.meta_value FROM test_terms t 
                                            INNER JOIN test_termmeta tm ON t.term_id=tm.term_id
                                            INNER JOIN test_term_taxonomy ttt ON t.term_id=ttt.term_id
                                            WHERE tm.meta_key = 'cc_color'
                                            AND ttt.taxonomy = 'post_destinos'");
        
        $tags_data = DB::select("SELECT t.term_id,t.name FROM test_terms t , test_term_taxonomy ttt
                                    WHERE t.term_id=ttt.term_id
                                    AND ttt.taxonomy = 'post_tag'");

        $posts = Post::status('publish')->orderBy('ID', 'DESC')->paginate(9);
        $posts = Post::status('publish')->limit(10)->orderBy('ID', 'DESC')->get();

        $review = Post::taxonomy('category', 'Reviews')->latest()->first();
        $reviews = Post::taxonomy('category', 'Reviews')->latest()->get();
        $things = Post::taxonomy('category', 'Things to do')->latest()->get();
        $events = Post::taxonomy('category', 'Events')->latest()->get();
        $new = Post::taxonomy('category', 'News')->latest()->first();
        $news = Post::taxonomy('category', 'News')->latest()->get();

        // dd($review->terms['post_destinos']);        

        return view('layouts.index', compact('reviews', 'review', 'things', 'events', 'news', 'new', 'destinations_data', 'tags_data'));
    }

    public function post(string $slug): View
    {
        return view('posts.index', [
            'post' => Post::slug($slug)->status('publish')->firstOrFail(),
        ]);
    }

    public function category(string $category): View
    {
        $categorydata = DB::select("SELECT t.term_id,t.name, tm.meta_value FROM test_terms t 
        INNER JOIN test_termmeta tm ON t.term_id=tm.term_id WHERE tm.meta_key = 'cc_color' ");

        $firstpostcategory = Post::taxonomy('category', $category)->latest()->first();
        $postscategory = Post::taxonomy('category', $category)->latest()->paginate(8);
        // dd($category);
        if ($category == "Reviews") {
            return view('categories.reviews', compact('categorydata', 'firstpostcategory', 'postscategory', 'category'));
        }
    }

    public function destiny($destiny)
    {
        dd($destiny);
    }
}
