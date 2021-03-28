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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Passport Authentication
Route::post('/signup', 'AuthController@signUp');

Route::group(['prefix' => 'auth','middleware' => 'auth:api'], function() {
    // Blog
    Route::get('/blogs', 'BlogController@index');
    Route::get('/blogs/create', 'BlogController@create');
    Route::post('/blog', 'BlogController@store');
    Route::get('/blog/{id}', 'BlogController@show');
    Route::get('/blog/edit/{id}', 'BlogController@edit');
    Route::put('/blog/{id}', 'BlogController@update');
    Route::delete('/blog/{id}', 'BlogController@destroy');
    // Gallery
    Route::get('/gallery', 'GalleryController@index');
    Route::get('/gallery/create', 'GalleryController@create');
    Route::post('/gallery', 'GalleryController@store');
    // Logout
    Route::get('/logout', 'AuthController@logOut');
});


