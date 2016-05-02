<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::any('login', 'LoginController@login');
    Route::pattern('id', '[0-9]+');

    Route::get('/', 'FrontController@home');
    Route::get('article/{id}', 'FrontController@show');
    Route::get('userPost/{id}', 'FrontController@userPost');
    Route::get('category/{id}', 'FrontController@showPostByCat');
    Route::group(['middleware' => 'auth'], function () {
        Route::resource('post', 'PostController');

    });
    Route::get('logout', 'LoginController@logout');
});
