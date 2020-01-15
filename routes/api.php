<?php

use App\Http\Controllers\Constants\Roles;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::get('cities', 'City\CityController@index')->name('cities');
    Route::get('citiesCoordinates', 'City\CityController@getByLan')->name('cities');

    Route::group(['prefix' => 'admin','middleware' => ['auth:api', 'HasRole:'. Roles::ROLE_ADMIN], 'namespace' => 'Admin'], function () {
        Route::post('posts/{post}/image', 'PostImagesController@store');
        Route::post('posts/{post}/changeMainImage', 'PostImagesController@changeMainImage');
        Route::delete('posts/{post}/image/{image}', 'PostImagesController@delete');
        Route::apiResource('users', 'UserController');
        Route::apiResource('posts', 'PostController')->except( 'show');
        Route::apiResource('categories', 'CategoryController')->except('index', 'show');
        Route::apiResource('announcements', 'AnnouncementController')->except(['store']);
        Route::apiResource('newsletters', 'NewsletterController')->only(['index', 'update', 'destroy']);
    });

    Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => ['auth:api']], function () {
        Route::get('user', 'UserController@user')->name('user');
        Route::put('{user}/update', 'UserController@update')->name('user.update');
        Route::post('{user}/avatar', 'ImagesController@store')->name('avatar.store');
        Route::delete('{user}/avatar', 'ImagesController@delete')->name('avatar.delete');
    });

    Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
        Route::get('posts/{post}/image', 'PostImagesController@index');
        Route::get('posts/{post}/image/{image}', 'PostImagesController@show');
        Route::apiResource('posts', 'PostController')->only('index', 'show');
        Route::apiResource('categories', 'CategoryController')->only('index', 'show');
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
