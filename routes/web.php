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

Route::get('/{category}', [PostsController::class, 'category'])->name('category');
Route::get('/{destination}', [PostsController::class, 'destination'])->name('destination');
Route::get('/{destination}/{category}', [PostsController::class, 'destinations'])->name('destination.category');
Route::get('/{events}', [PostsController::class, 'events'])->name('events');
Route::get('/{destination}/{category}/{slug}', [PostsController::class, 'post'])->name('post');
