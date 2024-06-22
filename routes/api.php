<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\authController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/v1/auth')->middleware(['throttle'])->group(function () {
    Route::post('/login', [authController::class, 'login']);
    Route::post('/register', [authController::class, 'register']);
});
Route::prefix('/v1/')->group(function () {
    Route::get('posts', [PostController::class, 'index']);
});
Route::prefix('/v1/')->middleware(['auth:sanctum'])->group(function () {
    Route::post('post', [PostController::class, 'store']);
    Route::get('post/show/{id?}', [PostController::class, 'show']);
    Route::put('post/edit/{id?}', [PostController::class, 'update']);
    Route::delete('post/delete/{id?}', [PostController::class, 'destroy']);

    Route::get('post/categories', [CategoryController::class, 'index']);
    Route::post('post/categories', [CategoryController::class, 'store']);
    Route::get('post/categories/show/{id?}', [CategoryController::class, 'show']);
    Route::put('post/category/edit/{id?}', [CategoryController::class, 'update']);
    Route::delete('post/category/delete/{id?}', [CategoryController::class, 'destroy']);
});
