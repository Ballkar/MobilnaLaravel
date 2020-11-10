<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {

    Route::group(['middleware' => ['auth:api']], function () {


        Route::group(['namespace' => 'Calendar'], function () {
            Route::apiResource('calendarWorks', 'CalendarWorksController')->except('show');
        });

        Route::get('user', 'UserController@user')->name('user');
        Route::apiResource('customers', 'CustomerController');
        Route::apiResource('messageSchemas', 'MessageSchemaController');
        Route::apiResource('messages', 'MessageController')->except('update', 'destroy');
    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('register', 'RegisterController@register')->name('register');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::post('logout', 'LoginController@logout')->name('logout');
        });
    });
});
