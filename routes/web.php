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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'admin', 'middleware'=>['auth','role:admin']], function () {
	Route::resource('customer', 'CustomerController');
	Route::resource('tabung', 'TabungController');
	Route::resource('ujiriksa', 'UjiriksaController');
	// Route::resource('service', 'ServiceController');
	Route::get('service', [
		'as' => 'service.index',
		'uses' => 'ServiceController@index'
		]);
	Route::get('service/{service}', [
		'as' => 'service.create',
		'uses' => 'ServiceController@create'
		]);
	Route::get('service/show/{service}', [
		'as' => 'service.show',
		'uses' => 'ServiceController@show'
		]);
	Route::post('service/store', [
		'as' => 'service.store',
		'uses' => 'ServiceController@store'
		]);
	Route::get('service/{service}/edit', [
		'as' => 'service.edit',
		'uses' => 'ServiceController@edit'
		]);
	Route::match(['put', 'patch'], 'service/update/{service}', [
		'as' => 'service.update',
		'uses' => 'ServiceController@update'
		]);
	Route::delete('service/destroy/{service}', [
		'as' => 'service.destroy',
		'uses' => 'ServiceController@destroy'
		]);

	
	Route::resource('billing', 'BillingController');
	Route::resource('user', 'UserController');
	// Route::resource('visualstatic', 'VisualstaticController');
	Route::get('visualstatic', [
		'as' => 'visualstatic.index',
		'uses' => 'VisualstaticController@index'
		]);
	Route::get('visualstatic/{visualstatic}', [
		'as' => 'visualstatic.create',
		'uses' => 'VisualstaticController@create'
		]);
	Route::get('visualstatic/show/{visualstatic}', [
		'as' => 'visualstatic.show',
		'uses' => 'VisualstaticController@show'
		]);
	Route::post('visualstatic/store', [
		'as' => 'visualstatic.store',
		'uses' => 'VisualstaticController@store'
		]);
	Route::get('visualstatic/{visualstatic}/edit', [
		'as' => 'visualstatic.edit',
		'uses' => 'VisualstaticController@edit'
		]);
	Route::match(['put', 'patch'], 'visualstatic/update/{visualstatic}', [
		'as' => 'visualstatic.update',
		'uses' => 'VisualstaticController@update'
		]);
	Route::delete('visualstatic/destroy/{visualstatic}', [
		'as' => 'visualstatic.destroy',
		'uses' => 'VisualstaticController@destroy'
		]);
	// Route::resource('hydrostatic', 'HydrostaticController');
	Route::get('hydrostatic', [
		'as' => 'hydrostatic.index',
		'uses' => 'HydrostaticController@index'
		]);
	Route::get('hydrostatic/{hydrostatic}', [
		'as' => 'hydrostatic.create',
		'uses' => 'HydrostaticController@create'
		]);
	Route::post('hydrostatic', [
		'as' => 'hydrostatic.store',
		'uses' => 'HydrostaticController@store'
		]);
	Route::get('hydrostatic/show/{hydrostatic}', [
		'as' => 'hydrostatic.show',
		'uses' => 'HydrostaticController@show'
		]);
	Route::get('hydrostatic/{hydrostatic}/edit', [
		'as' => 'hydrostatic.edit',
		'uses' => 'HydrostaticController@edit'
		]);
	Route::match(['put', 'patch'],'hydrostatic/{hydrostatic}', [
		'as' => 'hydrostatic.update',
		'uses' => 'HydrostaticController@update'
		]);
	Route::delete('hydrostatic/{hydrostatic}', [
		'as' => 'hydrostatic.destroy',
		'uses' => 'HydrostaticController@destroy'
		]);
	Route::get('createImport/hydrostatic', [
		'as' => 'hydrostatic.createImport',
		'uses' => 'HydrostaticController@import'
		]);

	Route::post('import/hydrostatic', [
		'as' => 'hydrostatic.import',
		'uses' => 'HydrostaticController@importExcel'
		]);	

	Route::get('template/hydrostatic', [
		'as' => 'hydrostatic.template',
		'uses' => 'HydrostaticController@generateExcelTemplate'
		]);
});