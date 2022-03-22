<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// sfrutto il middleware auth già usato in web.php
// e per far funzionare questo middlware c'è bisogno di configurare il kernel

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/posts", "Api\PostController@index");
// rotta show di un singolo post
Route::get("/posts/{post}", "Api\PostController@show");
// rotta dei contatti , dove c'è un form e l' utente farà il submit del form
Route::post("/contacts", "Api\ContactController@store");
