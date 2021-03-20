<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function () {

    Route::group(['middleware' => ['auth:api']], function () {
        Route::group(['middleware' => ['auth:api'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
            Route::post('wallet', 'WalletTransactionController@add');
            Route::apiResource('messages/plans/remind/schema', 'Message\Plans\RemindPlanSchemaController')->only('store', 'update');
        });

        Route::group(['namespace' => 'Calendar'], function () {
            Route::apiResource('calendar/works', 'WorksController')->except('index', 'show');
            Route::post('calendar/works/calendar', 'WorksController@index');
            Route::post('calendar/works/mass-update', 'WorksController@massUpdate');
            Route::apiResource('calendar/labels', 'LabelsController');
            Route::post('calendar/labels/mass-update', 'LabelsController@massUpdate');
        });
        Route::group(['namespace' => 'Message'], function () {
            Route::group(['namespace' => 'Plans', 'prefix' => 'messages/plans'], function () {
                Route::get('', 'PlansController@index');
                Route::get('remind', 'RemindPlanController@show');
                Route::put('remind', 'RemindPlanController@update');
                Route::post('remind/preview', 'RemindPlanController@preview');
                Route::get('remind/schema', 'RemindPlanSchemaController@index');
            });

            Route::post('messages/init', 'MessageController@initMessage');
            Route::apiResource('messages/history', 'MessageController')->except('store', 'update', 'destroy');
        });

        Route::group(['namespace' => 'User'], function () {
            Route::get('user', 'UserController@user')->name('user');
            Route::post('user', 'UserController@update')->name('user.update');
            Route::post('user/tutorial', 'UserController@markTutorialDone')->name('user.tutorial');
            Route::post('user/password', 'UserController@passwordChange')->name('user.passwordChange');
            Route::get('user/wallet', 'WalletController@get')->name('user.wallet');
            Route::get('notifications/calculate', 'NotificationController@calculate');
            Route::apiResource('notifications', 'NotificationController')->only(['index', 'show', 'delete']);
        });
        Route::apiResource('customers', 'CustomerController');
    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('register', 'RegisterController@register')->name('register');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::post('logout', 'LoginController@logout')->name('logout');
        });
    });
});
