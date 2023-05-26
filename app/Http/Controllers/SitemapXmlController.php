<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Post;
use App\Models\PostAll;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class SitemapXmlController extends Controller
{
    public function index() {

        $posts = PostALL::all();
        // dd($posts);
        return response()->view('sitemap.map', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');

        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
        SitemapGenerator::create(config('app.url'))->getSitemap()->writeToDisk('public', 'sitemap.xml');

    }

    public function feed()
    {
        $posts = Post::select('posts.post_title','posts.post_name as url','users.display_name','posts.post_date','posts.id as id_post','posts.post_content')
        ->join('users','posts.post_author','=','users.id')
        ->orderBy('posts.id','DESC')
        ->where('posts.post_status','publish')
        ->limit(10)->get();
        // dd($posts);

        return response()->view('sitemap.feed', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }
}
