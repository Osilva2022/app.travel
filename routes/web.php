<?php
use App\Http\Controllers\PostsController;
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

Route::get('/', [PostsController::class, 'index'])->name('home');

Route::get('destination/{destination}', [PostsController::class, 'destinations'])->name('destinations');
Route::get('reviews', [PostsController::class, 'reviews'])->name('reviews');
Route::get('news', [PostsController::class, 'news'])->name('news');
Route::get('events', [PostsController::class, 'events'])->name('events');
Route::get('things-to-do', [PostsController::class, 'things'])->name('things');
Route::get('/{destination}/{category}/post/{slug}', [PostsController::class, 'post'])->name('post');
Route::get('{destination}/things-to-do/{tag}', [PostsController::class, 'things_category'])->name('things_category');

Route::get('test', function()
{
    return view('test');
});
  