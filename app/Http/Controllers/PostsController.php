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
        
        $categories = DB::select("SELECT t.term_id,t.name, tm.meta_value FROM test_terms t 
        INNER JOIN test_termmeta tm ON t.term_id=tm.term_id WHERE tm.meta_key = 'cc_color' ");        

        $posts = Post::status('publish')->orderBy('ID','DESC')->paginate(9);  
        $posts = Post::status('publish')->limit(10)->orderBy('ID','DESC')->get();
              
        $review = Post::taxonomy('category', 'Reviews')->latest()->first();
        $reviews = Post::taxonomy('category', 'Reviews')->latest()->get();
        $things = Post::taxonomy('category', 'Things to do')->latest()->get();
        $events = Post::taxonomy('category', 'Events')->latest()->get();
        $new = Post::taxonomy('category', 'News')->latest()->first();
        $news = Post::taxonomy('category', 'News')->latest()->get();

        // $cat = Post::taxonomy('post_tag','!=','')->get();        
        // $new = htmlspecialchars_decode($new);
        // dd($new);        

        return view('posts.index',compact('categories', 'reviews', 'review', 'things', 'events', 'news', 'new'));      
       
    }

    public function show(string $slug): View
    {
        return view('posts.show', [
            'post' => Post::slug($slug)->status('publish')->firstOrFail(),
        ]);
    }

    public function category(string $category): View
    {
        $category = Post::taxonomy('category', $category)->latest()->paginate(10);
        // dd($category);

        return view('posts.category', compact('category'));
    }
    public function destiny($destiny)
    {
        dd($destiny);

    }
}
