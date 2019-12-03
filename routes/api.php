<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::get('cities', 'City\CityController@index')->name('cities');

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
        Route::post('{user}/avatar', 'ImagesController@store')->name('avatar.store');
    });

    Route::group(['namespace' => 'Announcement', 'middleware' => ['auth:api']], function () {
        Route::post('announcement/{announcement}/image', 'ImagesController@store');
        Route::get('announcement/{announcement}/image', 'ImagesController@index');
        Route::delete('announcement/{announcement}/image/{image}', 'ImagesController@delete');
        Route::post('announcement/{announcement}/changeMainImage', 'ImagesController@changeMainImage');
        Route::get('announcement/{announcement}/calendar', 'CalendarController@show');
        Route::apiResource('announcement', 'AnnouncementController');
        Route::apiResource('announcement.service', 'ServiceController');
        Route::apiResource('announcement.actionPeriodic', 'ActionPeriodicController');
        Route::apiResource('announcement.actionSingle', 'ActionSingleController');
        Route::apiResource('customer', 'CustomerController');
    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('register', 'RegisterController@register')->name('register');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::post('logout', 'LoginController@logout')->name('logout');
        });
    });

    Route::post('newsletter', 'NewsletterController@store')->name('newsletter.store');
    Route::delete('newsletter/{newsletter}', 'NewsletterController@destroy')->name('newsletter.destroy');
});
