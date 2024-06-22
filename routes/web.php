<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $param['featuredPost'] = Post::where('is_featured_post', 1)->first();
    $param['posts'] = Post::where('status', 1)->where('is_featured_post', 2)->get();
    return view('index', $param);
})->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Blog Posts Routes
Route::get('/blogs', [PostController::class, 'index'])->name('blog.index');
Route::get('/blogs/new', [PostController::class, 'create'])->name('blog.new');
Route::get('/blogs/show/{id?}', [PostController::class, 'show'])->name('blog.show');
Route::get('/blogs/edit/{id?}', [PostController::class, 'edit'])->name('blog.edit');
Route::post('/blogs/edit/{id?}', [PostController::class, 'update'])->name('blog.update');
Route::post('/blogs/show/{id?}', [PostController::class, 'addcomment'])->name('blog.addcomment');
Route::post('/blogs/new', [PostController::class, 'store'])->name('blog.create');
