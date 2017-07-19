<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('login', 'Auth\LoginController@loginAPI');

Route::get('ujiriksa', [
	'as' => 'ujiriksa.indexAll',
	'uses' => 'UjiriksaController@indexAll',
	
	]);

Route::get('inventory/tabung', [
	'as' => 'tabung.indexAll',
	'uses' => 'TabungController@indexAll',
	'middleware' => 'auth:api'
	]);

Route::get('inventory/alat', [
	'as' => 'alat.indexAll',
	'uses' => 'AlatController@indexAll',
	'middleware' => 'auth:api'
	]);

Route::get('showDetail/{id}', [
	'as' => 'ujiriksa.showDetail',
	'uses' => 'UjiriksaController@showDetail',
	'middleware' => 'auth:api'
	]);

Route::get('alat/showDetail/{id}', [
	'as' => 'alat.showDetail',
	'uses' => 'AlatController@showDetail',
	'middleware' => 'auth:api'
	]);

Route::get('tabung/showDetail/{id}', [
	'as' => 'tabung.showDetail',
	'uses' => 'TabungController@showDetail',
	'middleware' => 'auth:api'
	]);

Route::get('changeStatusAPI/ujiriksa', [
		'as' => 'ujiriksa.changeStatusAPI',
		'uses' => 'UjiriksaController@changeStatusAPI'
		]);

Route::get('service/create/{id}', [
		'as' => 'service.createAPI',
		'uses' => 'ServiceController@createAPI'
		]);

Route::get('visualstatic/create/{id}', [
		'as' => 'visualstatic.createAPI',
		'uses' => 'VisualstaticController@createAPI'
		]);

Route::post('ujiriksa/storeAPI', [
		'as' => 'ujiriksa.storeAPI',
		'uses' => 'UjiriksaController@storeAPI'
		]);

Route::post('service/storeAPI', [
		'as' => 'service.storeAPI',
		'uses' => 'ServiceController@storeAPI'
		]);

Route::post('visualstatic/storeAPI', [
		'as' => 'visualstatic.storeAPI',
		'uses' => 'VisualstaticController@storeAPI'
		]);