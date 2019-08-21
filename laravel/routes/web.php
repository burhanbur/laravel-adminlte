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
  
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/user', 'UserController@index')->name('user');
	Route::get('/user/edit/{id}', 'UserController@edit')->name('edit_user');
	Route::post('/user/store', 'UserController@store')->name('store_user');
	Route::put('/user/update/{id}', 'UserController@update')->name('update_user');
	Route::delete('/user/destroy/{id}', 'UserController@destroy')->name('delete_user');
});

