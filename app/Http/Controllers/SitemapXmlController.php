<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PostAll;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;

class SitemapXmlController extends Controller
{
    public function index() {
      
        $posts = PostAll::all();
        dd($posts);
        return response()->view('sitemap.index', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
        
        SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap2.xml'));
        SitemapGenerator::create(config('app.url'))->getSitemap()->writeToDisk('public', 'sitemap2.xml');


        
    }
}
