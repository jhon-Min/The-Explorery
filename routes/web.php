<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/detail/{slug}', [PageController::class, 'detail'])->name('detail');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('post', PostController::class);
Route::resource('comment', CommentController::class);
Route::resource('gallery', GalleryController::class);
Route::get('edit-profile', [HomeController::class, 'editProfile'])->name('edit-profile');
Route::post('update-profile', [HomeController::class, 'updateProfile'])->name('update-profile');
