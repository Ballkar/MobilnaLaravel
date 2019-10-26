<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::group(['middleware' => ['auth:api', 'HasRole:admin'], 'namespace' => 'Admin'], function () {
        Route::apiResource('categories', 'CategoryController');
        Route::apiResource('posts', 'PostController');
        Route::apiResource('users', 'UserController');
        Route::apiResource('announcements', 'AnnouncementController');
    });

    Route::get('user', 'UserController@user')->middleware('auth:api')->name('user');

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('register', 'RegisterController@register')->name('register');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::post('logout', 'LoginController@logout')->name('logout');
        });
    });


});
