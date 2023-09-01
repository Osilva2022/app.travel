<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PoliticsController;
use App\Http\Controllers\DailyBriefingController;
use App\Http\Controllers\SitemapXmlController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
Route::middleware('notfoundredirect')->group(function () {
//Redirect To Post
// Route::get('/vallarta-nayarit/{slug}/', [PostsController::class, 'postRedirect'])->name('vallartaRedirect');
// Route::get('/cancun-riviera-maya/{slug}/', [PostsController::class, 'postRedirect'])->name('cancunredirect');
Route::get('/columns/{slug}/', [PostsController::class, 'postRedirect'])->name('columnsRedirect');
Route::get('/mexico/{slug}/', [PostsController::class, 'postRedirect'])->name('mexicoRedirect');
Route::get('/world/{slug}/', [PostsController::class, 'postRedirect'])->name('worlsRedirect');
// Route::get('/puerto-vallarta-riviera-nayarit/{slug}/', [PostsController::class, 'postRedirect'])->name('vallartarivieraRedirect');

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
Route::get('/los-cabos/3-spots-to-discover-los-cabos/', function () {
    return redirect()->route('postRedirect', '3-spots-to-discover-los-cabo');
});
Route::get('/los-cabos/how-to-get-to-cabo-san-lucas/', function () {
    return redirect()->route('postRedirect', 'how-to-get-to-cabo-san-lucas');
});
Route::get('/cancun-riviera-maya', function () {
    return redirect()->route('home', 301);
});
Route::get('/mexico', function () {
    return redirect()->route('home', 301);
});
Route::get('/privacy-policy', function () {
    return redirect()->route('home', 301);
});
Route::get('/los-cabos/3-spots-to-discover-los-cabos/', function () {
    return redirect()->route('home');
});
Route::get('/cancun-riviera-maya/origin-of-pan-de-muerto/', function () {
    return redirect()->route('home');
});
Route::get('/los-cabos/beach-weddings-best-destination/', function () {
    return redirect()->route('postRedirect', 'beach-weddings-best-destination');
});
Route::get('/los-cabos/beer-is-brewtiful-as-life/', function () {
    return redirect()->route('postRedirect', 'beer-is-brewtiful-as-life');
});
Route::get('/los-cabos/cabos-longest-lazy-river-is-coming/', function () {
    return redirect()->route('postRedirect', 'cabos-longest-lazy-river-is-coming');
});
Route::get('/los-cabos/cerro-del-vigia-cabo-san-lucas-as-you-have-never-seen-it/', function () {
    return redirect()->route('postRedirect', 'cerro-del-vigia-cabo-san-lucas-as-you-have-never-seen-it');
});
Route::get('/los-cabos/dont-worry-beer-happy-in-oktoberfest/', function () {
    return redirect()->route('postRedirect', 'dont-worry-beer-happy-in-oktoberfest');
});
Route::get('/los-cabos/how-to-get-to-cabo-san-lucas/', function () {
    return redirect()->route('postRedirect', 'how-to-get-to-cabo-san-lucas');
});
Route::get('/los-cabos/how-to-relieve-stress-and-anxiety/', function () {
    return redirect()->route('postRedirect', 'how-to-relieve-stress-and-anxiety');
});
Route::get('/los-cabos/la-casona-a-top-restaurant-cabo/', function () {
    return redirect()->route('postRedirect', 'la-casona-a-top-restaurant-cabo');
});
Route::get('/los-cabos/planning-your-wellness-vacations/', function () {
    return redirect()->route('postRedirect', 'planning-your-wellness-vacations');
});
Route::get('/los-cabos/swimming-at-palmilla-beach-cabo/', function () {
    return redirect()->route('postRedirect', 'swimming-at-palmilla-beach-cabo');
});
Route::get('/los-cabos/tacos-of-many-and-any-thing/', function () {
    return redirect()->route('postRedirect', 'tacos-of-many-and-any-thing');
});
Route::get('/los-cabos/the-cabo-san-lucas-arch/', function () {
    return redirect()->route('postRedirect', 'the-cabo-san-lucas-arch');
});
Route::get('/los-cabos/travelers-and-tourists/', function () {
    return redirect()->route('postRedirect', 'travelers-and-tourists');
});
Route::get('/los-cabos/whale-shark-season-in-cabo/', function () {
    return redirect()->route('postRedirect', 'whale-shark-season-in-cabo');
});
Route::get('/los-cabos/what-is-the-deep-tissue-massage/', function () {
    return redirect()->route('postRedirect', 'what-is-the-deep-tissue-massage');
});
Route::get('/los-cabos/why-you-should-visit-los-cabos-in-summer/', function () {
    return redirect()->route('postRedirect', 'why-you-should-visit-los-cabos-in-summer');
});

Route::get('/cancun-riviera-maya/babies-and-kids-skincare/', function () {
    return redirect()->route('postRedirect', 'babies-and-kids-skincare');
});
Route::get('/cancun-riviera-maya/be-hot-with-coffee-spa-treatments/', function () {
    return redirect()->route('postRedirect', 'be-hot-with-coffee-spa-treatments');
});
Route::get('/cancun-riviera-maya/body-stretching-for-your-wellness/', function () {
    return redirect()->route('postRedirect', 'body-stretching-for-your-wellness');
});
Route::get('/cancun-riviera-maya/body-stretching-for-your-wellness/', function () {
    return redirect()->route('postRedirect', 'body-stretching-for-your-wellness');
});
Route::get('/cancun-riviera-maya/drinking-original-margarita/', function () {
    return redirect()->route('postRedirect', 'drinking-original-margarita');
});
Route::get('/cancun-riviera-maya/emotional-tourism-traveling/', function () {
    return redirect()->route('postRedirect', 'emotional-tourism-traveling');
});
Route::get('/cancun-riviera-maya/enjoy-the-health-benefits-of-yoga/', function () {
    return redirect()->route('postRedirect', 'enjoy-the-health-benefits-of-yoga');
});
Route::get('/cancun-riviera-maya/fun-and-fit-beach-activities/', function () {
    return redirect()->route('postRedirect', 'fun-and-fit-beach-activities');
});
Route::get('/cancun-riviera-maya/get-to-know-mexican-culture-on-your-vacations/', function () {
    return redirect()->route('postRedirect', 'get-to-know-mexican-culture-on-your-vacations');
});
Route::get('/cancun-riviera-maya/how-to-avoid-gaining-weight-during-the-holidays/', function () {
    return redirect()->route('postRedirect', 'how-to-avoid-gaining-weight-during-the-holidays');
});
Route::get('/cancun-riviera-maya/playa-gaviota-azul-a-beauty/', function () {
    return redirect()->route('postRedirect', 'playa-gaviota-azul-a-beauty');
});
Route::get('/cancun-riviera-maya/the-sweet-part-of-day-of-the-dead/', function () {
    return redirect()->route('postRedirect', 'the-sweet-part-of-day-of-the-dead');
});
Route::get('/cancun-riviera-maya/the-sweet-part-of-day-of-the-dead/', function () {
    return redirect()->route('postRedirect', 'the-sweet-part-of-day-of-the-dead');
});
Route::get('/cancun-riviera-maya/wedding-planner-or-wedding-coordinator/', function () {
    return redirect()->route('postRedirect', 'wedding-planner-or-wedding-coordinator');
});
Route::get('/cancun-riviera-maya/what-has-made-mexico-famous/', function () {
    return redirect()->route('postRedirect', 'what-has-made-mexico-famous');
});
Route::get('/cancun-riviera-maya/whats-in-a-cancun-name/', function () {
    return redirect()->route('postRedirect', 'whats-in-a-cancun-name');
});
Route::get('/puerto-vallarta-riviera-nayarit/sea-turtle-season/', function () {
    return redirect()->route('postRedirect', 'sea-turtle-season');
});
Route::get('/vallarta-nayarit/el-salado-estuary-lung-of-vallarta/', function () {
    return redirect()->route('home');
});
Route::get('/puerto-vallarta-riviera-nayarit/sea-turtle-seaso/', function () {
    return redirect()->route('postRedirect', 'sea-turtle-season');
});

Route::get('/puerto-vallarta-riviera-nayarit/puerto-vallarta-leads-recovery-of-beach-destinations/', function () {
    return redirect()->route('home');
});
Route::get('/puerto-vallarta-riviera-nayarit/puerto-vallarta-information/', function () {
    return redirect()->route('home');
});
Route::get('/puerto-vallarta-riviera-nayarit/puerto-vallarta-leads-recovery-of-beach-destinations/', function () {
    return redirect()->route('home');
});
Route::get('/puerto-vallarta-riviera-nayarit/wine-tasting-by-marival-group-at-mozzamare/', function () {
    return redirect()->route('home');
});
Route::get('/vallarta-nayarit', function () {
    return redirect()->route('home');
});
Route::get('/vallarta-nayarit/3-mountain-biking-routes-to-ride-in-the-bay/', function () {
    return redirect()->route('home');
});

Route::get('/vallarta-nayarit/emiliano-zapata-market-a-place-for-all/', function () {
    return redirect()->route('home');
});
Route::get('/vallarta-nayarit/el-salado-estuary-lung/', function () {
    return redirect()->route('home');
});
Route::get('/vallarta-nayarit/emiliano-zapata-market-a-place-for-all/', function () {
    return redirect()->route('home');
});
Route::get('/vallarta-nayarit/mandatory-vaccines-for-cruises/', function () {
    return redirect()->route('home');
});
Route::get('/vallarta-nayarit/puerto-vallarta-museum/', function () {
    return redirect()->route('home');
});
Route::get('/vallarta-nayarit/spectacular-opening-tierra-luna/', function () {
    return redirect()->route('home');
});
Route::get('/vallarta-nayarit/location-is-its-first-treasure/', function () {
    return redirect()->route('home');
});

Route::get('/cancun-riviera-maya/cancun-useful-information/', function () {
    return redirect()->route('postRedirect', 'cancun-useful-information');
});
Route::get('/cancun-riviera-maya/cancun-useful-information/', function () {
    return redirect()->route('postRedirect', 'cancun-useful-information');
});
Route::get('/vallarta-nayarit/wixarikas-wirraricas-or-huicholes/', function () {
    return redirect()->route('postRedirect', 'wixarikas-wirraricas-or-huicholes');
});
Route::get('/vallarta-nayarit/5-towns-to-visit-beach-edition/', function () {
    return redirect()->route('postRedirect', '5-towns-to-visit-beach-edition');
});
Route::get('/vallarta-nayarit/more-mountain-biking-routes-in-the-bay/', function () {
    return redirect()->route('postRedirect', 'more-mountain-biking-routes-in-the-bay');
});
Route::get('/destinos/blogs/hospiten-tells-us-about-memory-disorders-and-age/', function () {
    return redirect()->route('postRedirect', 'hospiten-tells-us-about-memory-disorders-and-age');
});
Route::get('/vallarta-nayarit/mountain-biking-routes-in-the-bay/', function () {
    return redirect()->route('postRedirect', 'mountain-biking-routes-in-the-bay');
});
Route::get('/vallarta-nayarit/mountain-biking-thrill-and-fun/', function () {
    return redirect()->route('postRedirect', 'mountain-biking-thrill-and-fun');
});
Route::get('/vallarta-nayarit/puerto-vallarta-useful-information/', function () {
    return redirect()->route('postRedirect', 'puerto-vallarta-useful-information');
});
Route::get('/vallarta-nayarit/riviera-farmers-market-a-place-to-be/', function () {
    return redirect()->route('postRedirect', 'riviera-farmers-market-a-place-to-be');
});
Route::get('/vallarta-nayarit/the-malecon-of-puerto-vallarta/', function () {
    return redirect()->route('postRedirect', 'the-malecon-of-puerto-vallarta');
});
Route::get('/vallarta-nayarit/top-lgbtq-destinations/', function () {
    return redirect()->route('postRedirect', 'top-lgbtq-destinations');
});
Route::get('/vallarta-nayarit/travel-journal-to-yelapa/', function () {
    return redirect()->route('postRedirect', 'travel-journal-to-yelapa');
});
Route::get('/vallarta-nayarit/travel-the-world-with-carry-on-only/', function () {
    return redirect()->route('postRedirect', 'travel-the-world-with-carry-on-only');
});
Route::get('/vallarta-nayarit/tuba-tejuino-vallarta-delicacies/', function () {
    return redirect()->route('postRedirect', 'tuba-tejuino-vallarta-delicacies');
});
Route::get('/cancun-riviera/babies-and-kids-skincare/', function () {
    return redirect()->route('postRedirect', 'babies-and-kids-skincare');
});

Route::get('/flights/{slug}/', [PostsController::class, 'flights'])->name('flights');
Route::get('subscribe', [ContactController::class, 'subscription'])->name('subscription');
Route::get('/posts/{slug}/', [PostsController::class, 'postRedirect'])->name('postRedirect');
Route::get('unsubscribe', [ContactController::class, 'unsubscribe'])->name('unsubscribe');
Route::post('/save/subscription', [ContactController::class, 'saveSubscription'])->name('save_subscription');
Route::post('/save/unsubscribe', [ContactController::class, 'saveUnsubscribe'])->name('save_unsubscribe');

//Redirect To Post
Route::get('/', [PostsController::class, 'index'])->name('home');
Route::get('destination/{destination}', [DestinationsController::class, 'destinations'])->name('destinations');
Route::get('tag/{tag}', [PostsController::class, 'tags'])->name('tags');
Route::get('category/daily-briefing', [DailyBriefingController::class, 'dailyBriefing'])->name('daily');
Route::get('category/{category}', [CategoriesController::class, 'categories'])->name('category');
Route::get('events', [EventController::class, 'events'])->name('events');
Route::get('events/{destination}/{slug}', [EventController::class, 'event'])->name('event');
Route::get('author/{id}', [AuthorController::class, 'author'])->name('author');
Route::get('directory-item', [GuideController::class, 'ShowGuideItem'])->name('directory-item');
Route::get('/{destination}/{category}/{slug}', [PostsController::class, 'post'])->name('post');
Route::get('guide', [GuideController::class, 'guide'])->name('guide');
Route::get('{destination}/{tag}', [GuideController::class, 'guide_category'])->name('guide_category');
Route::get('gallery', function () {
    return view('things_to_do.gallery', ['gallery' => '{gallery}']);
});
Route::get('get-posts-tags', [PostsController::class, 'PostsTags'])->name('get-posts-tags');
Route::get('cookies-notice', [PoliticsController::class, 'cookies'])->name('cookies');
Route::get('privacy-notice', [PoliticsController::class, 'privacy'])->name('privacy');
Route::get('sitemap', [PoliticsController::class, 'sitemap'])->name('sitemap');
Route::get('contact-us', [ContactController::class, 'contact'])->name('contact');
Route::post('/save-contact', [ContactController::class, 'storeContact'])->name('save-contact');
Route::get('search', [PostsController::class, 'search'])->name('search');
Route::resource('files', 'FileController');
// Route::get('/sitemap.xml', [SitemapXmlController::class, 'index']);
Route::get('/feed', [SitemapXmlController::class, 'feed']);
Route::get('/rss', function () {
    return Redirect::to('/feed', 301);
});
Route::get('/{id}', [PostsController::class, 'postid'])->name('postid');
Route::get('destination/{destination}/feed', [PostsController::class, 'destinations_feed'])->name('destinations_feed');
});
