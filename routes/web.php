<?php

use App\Http\Controllers\Admin\PostController;
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


Auth::routes();

Route::middleware("auth")
    ->namespace("Admin")
    ->prefix("admin")
    ->name("admin.")
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get("posts/deletedPosts", "PostController@deletedPosts")->name('posts.deletedPosts');
        Route::delete("posts/{post}/deleteThePost", "PostController@deleteThePost")->name('posts.deleteThePost');
        Route::get("posts/{post}/restore","PostController@restore")->name("posts.restore");
        // rotta crude  per i posts
        Route::resource("posts", "PostController");
    });

// se non vede niente torna all'home
// che stamperà vue js
Route::get("{any?}", function () {
    return view("home");
})->where("any", ".*");
