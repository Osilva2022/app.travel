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
Route::get('category/{category}', [PostsController::class, 'category'])->name('category');
Route::get('{destination}/{category}', [PostsController::class, 'destination_category'])->name('destination.category');
Route::get('{destination}/{category}/{tag}', [PostsController::class, 'destination_tag'])->name('destination.tag');

Route::get('post/events', [PostsController::class, 'events'])->name('post.events');
Route::get('nosotros', 'PostsController@events')->name('nosotros');
Route::get('{destination}/{category}/{slug}', [PostsController::class, 'post'])->name('post');
