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

// Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function () {
Route::group(['prefix'=>'admin'], function () {
	Route::get('/dashboard', 'dashboardController@index')->name('dashboard');
	Route::resource('customer', 'CustomerController');
	Route::resource('tabung', 'TabungController');
	Route::resource('ujiriksa', 'UjiriksaController');
	Route::resource('user', 'UserController');
	Route::resource('laporan', 'LaporanController');
	Route::resource('billing', 'BillingController');
});
