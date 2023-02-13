<?php

use App\Http\Livewire\Favorite\Index;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();


Route::get('tag/{tag}', 'PostController@tag');
Route::resource('users', UserController::class)->only('index','show','edit','update');
Route::resource('posts', PostController::class);
Route::resource('posts.comments', CommentController::class)->only(['store','destroy']);
Route::resource('tags', TagController::class)->only(['store','index','destroy']);
Route::resource('favorite', FavoriteController::class)->only(['store','destroy','index']);