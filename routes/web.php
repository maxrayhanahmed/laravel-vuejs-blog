<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//route for Category

//Route::get('/{anypath}', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('/add-category', [App\Http\Controllers\CategoryController::class, 'store']);
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/active-category', [App\Http\Controllers\CategoryController::class, 'activeCategorics']);
Route::get('/remove-category/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
Route::get('/edit-category/{slug}', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::post('/update-category', [App\Http\Controllers\CategoryController::class, 'update']);

Route::post('/remove-categories', [App\Http\Controllers\CategoryController::class, 'removeSelectData']);
Route::post('/categories/change-status', [App\Http\Controllers\CategoryController::class, 'changeStatus']);

//route for posts
Route::get('/post-list', [App\Http\Controllers\PostController::class, 'index']);
Route::get('/remove-post/{slug}', [App\Http\Controllers\PostController::class, 'destroy']);

Route::post('/remove-posts', [App\Http\Controllers\PostController::class, 'removeSelectData']);
Route::post('/posts/change-status', [App\Http\Controllers\PostController::class, 'changeStatus']);
Route::post('/add-post', [App\Http\Controllers\PostController::class, 'store']);

Route::get('/edit-post/{slug}', [App\Http\Controllers\PostController::class, 'edit']);
Route::post('/update-post', [App\Http\Controllers\PostController::class, 'update']);
