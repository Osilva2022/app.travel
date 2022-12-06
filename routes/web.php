<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\SitemapXmlController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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
Route::get('/vallarta-nayarit/{slug}/', [PostsController::class, 'postRedirect'])->name('vallartaRedirect');
Route::get('/cancun-riviera-maya/{slug}/', [PostsController::class, 'postRedirect'])->name('cancunredirect');
Route::get('/columns/{slug}/', [PostsController::class, 'postRedirect'])->name('columnsRedirect');
// Route::get('/los-cabos/{slug}/', [PostsController::class, 'postRedirect'])->name('loscabosRedirect');
Route::get('/mexico/{slug}/', [PostsController::class, 'postRedirect'])->name('mexicoRedirect');
// Route::get('/riviera-nayarit/{slug}/', [PostsController::class, 'postRedirect'])->name('rivieraRedirect');
Route::get('/world/{slug}/', [PostsController::class, 'postRedirect'])->name('worlsRedirect');
Route::get('/puerto-vallarta-riviera-nayarit/{slug}/', [PostsController::class, 'postRedirect'])->name('vallartarivieraRedirect');

Route::get('/cancun-riviera-maya/what-is-a-hydrotherapy-spa/', function () {
    return redirect()->route('postRedirect', 'what-is-a-hydrotherapy-spa');
});
Route::get('/mexico/what-do-i-need-to-travel-to-mexico/', function () {
    return redirect()->route('postRedirect', 'what-do-i-need-to-travel-to-mexico');
});
Route::get('/cancun-riviera-maya/enjoy-mexico-hidden-beaches/', function () {
    return redirect()->route('postRedirect', 'enjoy-mexico-hidden-beaches');
});
Route::get('/columns/mexican-street-vendors-whats-behind-your-purchase/', function () {
    return redirect()->route('postRedirect', 'mexican-street-vendors-whats-behind-your-purchase');
});
Route::get('/mexico/history-of-mexican-hotel-industry/', function () {
    return redirect()->route('postRedirect', 'history-of-mexican-hotel-industry');
});
Route::get('/los-cabos/experience-los-cabos-like-a-local/', function () {
    return redirect()->route('postRedirect', 'experience-los-cabos-like-a-local');
});
Route::get('/cancun-riviera-maya/quintana-roo-governor-mara-lezama-introduces-her-cabinet/', function () {
    return redirect()->route('postRedirect', 'quintana-roo-governor-mara-lezama-introduces-her-cabinet');
});
Route::get('/columns/mexican-cuisine-changed-and-forgotten/', function () {
    return redirect()->route('postRedirect', 'mexican-cuisine-changed-and-forgotten');
});
Route::get('/los-cabos/3-day-trips-from-cabo-san-lucas/', function () {
    return redirect()->route('postRedirect', '3-day-trips-from-cabo-san-lucas');
});
Route::get('/los-cabos/justin-bieber-vacations-at-los-cabos/', function () {
    return redirect()->route('postRedirect', 'justin-bieber-vacations-at-los-cabos');
});
Route::get('/los-cabos/los-cabos-hurricane-season/', function () {
    return redirect()->route('postRedirect', 'los-cabos-hurricane-season');
});
Route::get('/los-cabos/turtle-nesting-season-starts-at-la-paz/', function () {
    return redirect()->route('postRedirect', 'turtle-nesting-season-starts-at-la-paz');
});
Route::get('/los-cabos/los-cabos-useful-information/', function () {
    return redirect()->route('postRedirect', 'los-cabos-useful-information');
});
Route::get('/los-cabos/balandra-beach-a-gem-in-the-baja/', function () {
    return redirect()->route('postRedirect', 'balandra-beach-a-gem-in-the-baja');
});
Route::get('/sin-categoria/vallarta-tribune-to-become-tribune-travel/', function () {
    return redirect()->route('postRedirect', 'vallarta-tribune-tribune-travel');
});
Route::get('/posts/{slug}/', [PostsController::class, 'postRedirect'])->name('postRedirect');
//Redirect To Post

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
Route::get('cookies-notice', [PostsController::class, 'cookies'])->name('cookies');
Route::get('privacy-notice', [PostsController::class, 'privacy'])->name('privacy');
Route::get('sitemap', [PostsController::class, 'sitemap'])->name('sitemap');

Route::get('contact-us', [PostsController::class, 'contact'])->name('contact');
Route::post('/save-contact', [PostsController::class, 'storeContact'])->name('save-contact');
Route::get('search', [PostsController::class, 'search'])->name('search');

Route::resource('files', 'FileController');
Route::get('/sitemap.xml', [SitemapXmlController::class, 'index']);
Route::get('/feed', [SitemapXmlController::class, 'feed']);
Route::get('/rss', function () {
    return Redirect::to('/feed', 301);

});

Route::get('/{id}', [PostsController::class, 'postid'])->name('postid');

Route::get('destination/{destination}/feed', [PostsController::class, 'destinations_feed'])->name('destinations_feed');
