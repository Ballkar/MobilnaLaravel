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


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/login', 'Admin\DashboardController@showLoginForm');
Route::post('/admin/login', 'Admin\DashboardController@login');
//Route::get('/admin/logout', 'Admin\DashboardController@logout');

Route::get('/admin/dashboard', 'Admin\DashboardController@index');

