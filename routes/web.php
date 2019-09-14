<?php

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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin/')->group(function () {
    Route::get('/login', 'DashboardController@showLoginForm');
    Route::post('/login', 'DashboardController@login');
    Route::get('/dashboard', 'DashboardController@index');
    Route::resource('blog/category', 'CategoryController');
    Route::resource('blog/post', 'PostController');

});

