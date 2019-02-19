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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/mystore', 'HomeController@mystore')->name('mystore');
Route::get('/mystore/bargain-list', 'HomeController@bargainList')->name('mystore-bargain-list');
Route::get('/cart', 'HomeController@mycart')->name('mycart');
Route::post('/editStore', 'HomeController@editStore');
Route::post('/addToCart', 'HomeController@addToCart');
Route::post('/removeFromCart', 'HomeController@removeFromCart');
Route::resource('/product', 'ProductController');
Route::resource('/bargain-list', 'BargainListController');
Route::resource('/transaction', 'TransactionController');
Route::get('/verify/{id}', 'TransactionController@showVerify')->name('verify.show');
Route::post('/verify/{id}', 'TransactionController@verifyPayment')->name('verify');
Route::get('/bargain-list/{id}/{status}', 'BargainListController@updateStatus');
Route::get('/profile', 'HomeController@showProfile');
Route::post('/editProfile', 'HomeController@editProfile');
Route::post('/changePassword', 'HomeController@changePassword');
