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


Route::get('/test', "TestController@index");


Route::get('/chat', "ChatController@index");
Route::get('/chat/messages', 'ChatController@messages');
Route::post('/chat', 'ChatController@store');


Route::post('/messages/getuser', 'ConversationsController@getUser');
Route::get('/messages/{id}', 'ConversationsController@index');
Route::post('/messages', 'ConversationsController@sendMessage');


Route::get('/artists', function(){return view('artists');})->middleware('isadmin');


Route::resource('albums', "AlbumsController");


Route::get('/users/index', "UsersController@index");
Route::post('/users/changestatus', "UsersController@changeStatus");
Route::get('/users/edit', "UsersController@edit");
Route::post('/users/changepassword', "UsersController@changePassword");
Route::post('/users/changeavatar', "UsersController@changeAvatar");
Route::get('/users/{idUser}', "UsersController@show");


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


