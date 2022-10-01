<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\SitemapXmlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Redirect To Post
Route::get('/vallarta-nayarit/{slug}/', [PostsController::class, 'postRedirect'])->name('postRedirect');
// Route::get('/los-cabos/{slug}/', [PostsController::class, 'postRedirect'])->name('postRedirect2');

Route::get('/', [PostsController::class, 'index'])->name('home');


Route::get('destination/{destination}', [PostsController::class, 'destinations'])->name('destinations');
Route::get('tag/{tag}', [PostsController::class, 'tags'])->name('tags');

Route::get('category/{category}', [PostsController::class, 'categories'])->name('category');

Route::get('events', [PostsController::class, 'events'])->name('events');
Route::get('author/{id}', [PostsController::class, 'author'])->name('author');
Route::get('directory-item', [PostsController::class, 'ShowGuideItem'])->name('directory-item');
Route::get('/{destination}/{category}/{slug}', [PostsController::class, 'post'])->name('post');
Route::get('guide', [PostsController::class, 'guide'])->name('guide');
Route::get('{destination}/{tag}', [PostsController::class, 'guide_category'])->name('guide_category');
Route::get('gallery', function () {
    return view('things_to_do.gallery', ['gallery' => '{gallery}']);
});
Route::get('get-posts-tags', [PostsController::class, 'PostsTags'])->name('get-posts-tags');
Route::get('policy-cookies', [PostsController::class, 'cookies'])->name('cookies');
Route::get('policy-privacy', [PostsController::class, 'privacy'])->name('privacy');
Route::get('sitemap', [PostsController::class, 'sitemap'])->name('sitemap');

Route::get('contact-us', [PostsController::class, 'contact'])->name('contact');
Route::post('/save-contact', [PostsController::class, 'storeContact'])->name('save-contact');

Route::resource('files', 'FileController');
Route::get('/sitemap.xml', [SitemapXmlController::class, 'index']);
Route::get('/feed', [SitemapXmlController::class, 'feed']);
Route::get('/rss', function () {
    return redirect('/feed');
});
