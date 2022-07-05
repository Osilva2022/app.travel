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
Route::get('/post/{post:slug}', [PostsController::class, 'post'])->name('post');
Route::get('/category/{category}', [PostsController::class, 'category'])->name('posts.category');
Route::get('/destiny', [PostsController::class, 'destiny'])->name('posts.destiny');

Route::get('/{destino}/{category}/{slug}', [PostsController::class, 'post'])->name('post2');
