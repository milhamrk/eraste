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

Route::group(['middleware' => ['auth']], function() {
	Route::get('/admin', 'ProductController@index')->name('product');

	Route::get('/product', 'ProductController@index')->name('product');
	Route::post('/product', 'ProductController@store')->name('product.store');
	Route::get('/product/create', 'ProductController@create')->name('product.create');
	Route::delete('/product/{id}', 'ProductController@destroy')->name('product.destroy');
	Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
	Route::post('/product/edit/{id}', 'ProductController@update')->name('product.update');

	Route::get('/order', 'OrderController@index')->name('order');
	Route::get('/order/{id}', 'OrderController@edit')->name('order.edit');
	Route::post('/order/{id}', 'OrderController@update')->name('order.update');
	Route::delete('/order/{id}', 'OrderController@destroy')->name('order.destroy');
	
	Route::get('/user', 'UserController@index')->name('user');
	Route::get('/user/create', 'UserController@create')->name('user.create');
	Route::post('/user', 'UserController@store')->name('user.store');
	Route::get('/user/{id}', 'UserController@edit')->name('user.edit');
	Route::post('/user/{id}', 'UserController@update')->name('user.update');
	Route::delete('/user/{id}', 'UserController@destroy')->name('user.destroy');
});

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Guest Home
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/beli/{id}', 'HomeController@form')->name('beli');
Route::post('/success', 'HomeController@success')->name('success');