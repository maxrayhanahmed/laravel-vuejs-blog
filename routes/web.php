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

// this route for frontend

Route::get('/', [App\Http\Controllers\frontend\Homecontroller::class, 'index']);
Route::get('/front-posts', [App\Http\Controllers\frontend\Homecontroller::class, 'frontPosts']);

Route::get('/front-active-category', [App\Http\Controllers\frontend\Homecontroller::class, 'frontActiveCategory']);

Route::get('/category-post/{slug}', [App\Http\Controllers\frontend\Homecontroller::class, 'categoryPost']);
Route::get('/single-post/{slug}', [App\Http\Controllers\frontend\Homecontroller::class, 'singlePost']);


// Route::get('/', function () {
//     return view('welcome');
// });


//this route for backend

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//route for Category

//Route::get('/{anypath}', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('/add-category', [App\Http\Controllers\backend\CategoryController::class, 'store']);
Route::get('/category', [App\Http\Controllers\backend\CategoryController::class, 'index']);
Route::get('/active-category', [App\Http\Controllers\backend\CategoryController::class, 'activeCategorics']);
Route::get('/remove-category/{id}', [App\Http\Controllers\backend\CategoryController::class, 'destroy']);
Route::get('/edit-category/{slug}', [App\Http\Controllers\backend\CategoryController::class, 'edit']);
Route::post('/update-category', [App\Http\Controllers\backend\CategoryController::class, 'update']);

Route::post('/remove-categories', [App\Http\Controllers\backend\CategoryController::class, 'removeSelectData']);
Route::post('/categories/change-status', [App\Http\Controllers\backend\CategoryController::class, 'changeStatus']);

//route for posts
Route::get('/post-list', [App\Http\Controllers\backend\PostController::class, 'index']);
Route::get('/remove-post/{slug}', [App\Http\Controllers\backend\PostController::class, 'destroy']);

Route::post('/remove-posts', [App\Http\Controllers\backend\PostController::class, 'removeSelectData']);
Route::post('/posts/change-status', [App\Http\Controllers\backend\PostController::class, 'changeStatus']);
Route::post('/add-post', [App\Http\Controllers\backend\PostController::class, 'store']);

Route::get('/edit-post/{slug}', [App\Http\Controllers\backend\PostController::class, 'edit']);
Route::post('/update-post', [App\Http\Controllers\backend\PostController::class, 'update']);

