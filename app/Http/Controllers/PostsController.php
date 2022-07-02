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

        $posts = Post::status('publish')->orderBy('ID','DESC')->paginate(5);  
        $review = Post::taxonomy('category', 'Reviews')->first();
        $reviews = Post::taxonomy('category', 'Reviews')->paginate(3);
        $posts = Post::status('publish')->limit(10)->orderBy('ID','DESC')->get();  
        $review = Post::taxonomy('category', 'Reviews')->last();
        $reviews = Post::taxonomy('category', 'Reviews')->get();
        $things = Post::taxonomy('category', 'Things to do')->get();
        $events = Post::taxonomy('category', 'Events')->get();
        $new = Post::taxonomy('category', 'News')->last();
        $news = Post::taxonomy('category', 'News')->get();

        // $cat = Post::taxonomy('post_tag','!=','')->get();
        

        // dd($posts);        

<<<<<<< HEAD
        return view('posts.index',compact('categories', 'reviews', 'review', 'things', 'events', 'news', 'new'));      
       
=======
        return view('posts.index',compact('posts','categories','attachment', 'reviews', 'review', 'things', 'events', 'news', 'new'));      
      
>>>>>>> 16bceb103b0beb56878bf4dee8d72c6bd0d70aa6
    }

    public function show(string $slug): View
    {
        return view('posts.show', [
            'post' => Post::slug($slug)->status('publish')->firstOrFail(),
        ]);
    }
}
