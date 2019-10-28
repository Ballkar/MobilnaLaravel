<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::group(['prefix' => 'admin','middleware' => ['auth:api', 'HasRole:admin'], 'namespace' => 'Admin'], function () {
        Route::apiResource('categories', 'CategoryController');
        Route::apiResource('posts', 'PostController');
        Route::apiResource('users', 'UserController');
        Route::apiResource('announcements', 'AnnouncementController')->except(['store']);
        Route::apiResource('newsletters', 'NewsletterController')->only(['index', 'update', 'destroy']);
    });

    Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => ['auth:api']], function () {
        Route::get('user', 'UserController@user')->name('user');
        Route::put('{user}/update', 'UserController@update')->name('user.update');
    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('register', 'RegisterController@register')->name('register');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::post('logout', 'LoginController@logout')->name('logout');
        });
    });


});
