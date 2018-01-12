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

// Authentication Routes...
Route::get('auth/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('auth/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('auth/register', 'Auth\RegisterController@register');

Route::get('/', 'Front\HomeController@index');
Route::get('/search/{number}', 'Front\AdsController@search'); //search phone number
Route::get('/{city}', 'Front\AdsController@index')->where('city', '[a-z\-]+');
Route::get('/{city}/{number}/images', 'Front\AdsController@images')->where('city', '[a-z\-]+')->where('number', '[0-9\-]+');
Route::get('/{city}/{number}/history', 'Front\AdsController@history')->where('city', '[a-z\-]+')->where('number', '[0-9\-]+');
Route::get('/{city}/{number}/{category?}', 'Front\AdsController@show')->where('city', '[a-z\-]+')->where('number', '[0-9\-]+');

Route::get('/set/cookie/{id}/{name}', 'Front\AdsController@setCookie');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
