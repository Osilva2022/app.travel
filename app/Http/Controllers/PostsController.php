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
        $posts = DB::select("SELECT p.id, p.post_date, p.post_title, p.post_content, p.post_name, t.name as category, p.post_parent
        FROM test_posts p INNER JOIN test_term_relationships tr ON p.id= tr.object_id INNER JOIN test_terms t ON t.term_id= tr.term_taxonomy_id
        WHERE post_status ='publish' AND p.post_type='post' ORDER BY id DESC");
        
        $categories = DB::select("SELECT t.term_id,t.name,  tm.meta_value FROM test_terms t 
        INNER JOIN test_termmeta tm ON t.term_id=tm.term_id  WHERE tm.meta_key = 'cc_color' ");
        $attachment = DB::select("SELECT id,post_parent, post_name, guid as url  FROM test_posts 
        WHERE post_type='attachment' AND post_parent <> 0  ORDER BY post_parent ASC;");        

        $posts = Post::status('publish')->limit(10)->orderBy('ID','DESC')->get();  
        $review = Post::taxonomy('category', 'Reviews')->last();
        $reviews = Post::taxonomy('category', 'Reviews')->get();
        $things = Post::taxonomy('category', 'Things to do')->get();
        $events = Post::taxonomy('category', 'Events')->get();
        $new = Post::taxonomy('category', 'News')->last();
        $news = Post::taxonomy('category', 'News')->get();
        // $cat = Post::taxonomy('post_tag','!=','')->get();

        // dd($categories);

        return view('posts.index',compact('posts','categories','attachment', 'reviews', 'review', 'things', 'events', 'news', 'new'));      
      
    }

    public function show(string $slug): View
    {
        return view('posts.show', [
            'post' => Post::slug($slug)->status('publish')->firstOrFail(),
        ]);
    }
}
