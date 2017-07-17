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

Route::get('/', "AlbumsController@index");
Route::resource('albums', "AlbumsController");
Route::get('/users/index', "UsersController@index");
Route::post('/users/changestatus', "UsersController@changeStatus");
Route::get('/users/changestatus', "UsersController@changeStatus");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
