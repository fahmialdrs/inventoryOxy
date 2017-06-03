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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [
		'as' => 'homepage',
		'uses' => 'HomepageController@homepage'
		]);

Route::get('/homepage/result', [
		'as' => 'homepage.result',
		'uses' => 'HomepageController@result'
		]);

Route::get('/homepage/result/showHydrostatic/{id}', [
		'as' => 'homepage.showHydrostatic',
		'uses' => 'HomepageController@showHydrostatic'
		]);

Route::get('/homepage/result/showAllHydrostatic/{id}', [
		'as' => 'homepage.showAllHydrostatic',
		'uses' => 'HomepageController@showAllHydrostatic'
		]);

Route::get('/homepage/result/showVisual/{id}', [
		'as' => 'homepage.showVisual',
		'uses' => 'HomepageController@showVisual'
		]);

Route::get('/homepage/result/showAllVisual/{id}', [
		'as' => 'homepage.showAllVisual',
		'uses' => 'HomepageController@showAllVisual'
		]);

Route::get('/homepage/result/showService/{id}', [
		'as' => 'homepage.showService',
		'uses' => 'HomepageController@showService'
		]);

Route::get('/homepage/result/showAllService/{id}', [
		'as' => 'homepage.showAllService',
		'uses' => 'HomepageController@showAllService'
		]);


Auth::routes();

// Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'admin', 'middleware'=>['auth','role:admin']], function () {

	Route::get('/home', 'HomeController@index');
	
	// Route::resource('customer', 'CustomerController');
	Route::get('inventory', [
		'as' => 'customer.index',
		'uses' => 'CustomerController@index'
		]);

	Route::get('customer/create', [
		'as' => 'customer.create',
		'uses' => 'CustomerController@create'
		]);
	Route::get('customer/show/{customer}', [
		'as' => 'customer.show',
		'uses' => 'CustomerController@show'
		]);
	Route::post('customer/store', [
		'as' => 'customer.store',
		'uses' => 'CustomerController@store'
		]);
	Route::get('customer/{customer}/edit', [
		'as' => 'customer.edit',
		'uses' => 'CustomerController@edit'
		]);
	Route::match(['put', 'patch'], 'customer/update/{customer}', [
		'as' => 'customer.update',
		'uses' => 'CustomerController@update'
		]);
	Route::get('customer/destroy/{id}', [
		'as' => 'customer.destroy',
		'uses' => 'CustomerController@destroy'
		]);
	Route::get('exportExcel/customer', [
		'as' => 'customer.exportExcel',
		'uses' => 'CustomerController@exportExcel'
		]);


	// Route::resource('tabung', 'TabungController');
	Route::get('tabung', [
		'as' => 'tabung.index',
		'uses' => 'TabungController@index'
		]);

	Route::get('tabung/create', [
		'as' => 'tabung.create',
		'uses' => 'TabungController@create'
		]);
	Route::get('tabung/show/{tabung}', [
		'as' => 'tabung.show',
		'uses' => 'TabungController@show'
		]);
	Route::post('tabung/store', [
		'as' => 'tabung.store',
		'uses' => 'TabungController@store'
		]);
	Route::get('tabung/{tabung}/edit', [
		'as' => 'tabung.edit',
		'uses' => 'TabungController@edit'
		]);
	Route::match(['put', 'patch'], 'tabung/update/{tabung}', [
		'as' => 'tabung.update',
		'uses' => 'TabungController@update'
		]);
	Route::get('tabung/destroy/{id}', [
		'as' => 'tabung.destroy',
		'uses' => 'TabungController@destroy'
		]);
	Route::get('barcode/tabung/{id}', [
		'as' => 'tabung.barcode',
		'uses' => 'TabungController@printBarcode'
		]);
	Route::get('exportExcel/tabung', [
		'as' => 'tabung.exportExcel',
		'uses' => 'TabungController@exportExcel'
		]);


	// Route::resource('ujiriksa', 'UjiriksaController');
	Route::get('ujiriksa', [
		'as' => 'ujiriksa.index',
		'uses' => 'UjiriksaController@index'
		]);

	Route::get('ujiriksa/create', [
		'as' => 'ujiriksa.create',
		'uses' => 'UjiriksaController@create'
		]);
	Route::get('ujiriksa/show/{ujiriksa}', [
		'as' => 'ujiriksa.show',
		'uses' => 'UjiriksaController@show'
		]);
	Route::post('ujiriksa/store', [
		'as' => 'ujiriksa.store',
		'uses' => 'UjiriksaController@store'
		]);
	Route::get('ujiriksa/{ujiriksa}/edit', [
		'as' => 'ujiriksa.edit',
		'uses' => 'UjiriksaController@edit'
		]);
	Route::match(['put', 'patch'], 'ujiriksa/update/{ujiriksa}', [
		'as' => 'ujiriksa.update',
		'uses' => 'UjiriksaController@update'
		]);
	Route::get('ujiriksa/destroy/{id}', [
		'as' => 'ujiriksa.destroy',
		'uses' => 'UjiriksaController@destroy'
		]);
	Route::post('ujiriksa/storePengambil/{id}', [
		'as' => 'ujiriksa.storePengambil',
		'uses' => 'UjiriksaController@storePengambil'
		]);
	Route::get('changeStatus/ujiriksa/{id}', [
		'as' => 'ujiriksa.changeStatus',
		'uses' => 'UjiriksaController@changeStatus'
		]);
	Route::get('export/ujiriksa/{id}', [
		'as' => 'ujiriksa.exportPdf',
		'uses' => 'UjiriksaController@exportPdf'
		]);

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
	Route::get('service/showAll/{id}', [
		'as' => 'service.showAll',
		'uses' => 'ServiceController@showAll'
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

	// route billing

	Route::get('billing', [
		'as' => 'billing.index',
		'uses' => 'BillingController@index'
		]);

	Route::get('billing/create', [
		'as' => 'billing.create',
		'uses' => 'BillingController@create'
		]);
	Route::get('billing/show/{billing}', [
		'as' => 'billing.show',
		'uses' => 'BillingController@show'
		]);
	Route::post('billing/store', [
		'as' => 'billing.store',
		'uses' => 'BillingController@store'
		]);
	Route::get('billing/{billing}/edit', [
		'as' => 'billing.edit',
		'uses' => 'BillingController@edit'
		]);
	Route::match(['put', 'patch'], 'billing/update/{billing}', [
		'as' => 'billing.update',
		'uses' => 'BillingController@update'
		]);
	Route::get('billing/destroy/{id}', [
		'as' => 'billing.destroy',
		'uses' => 'BillingController@destroy'
		]);

	Route::get('changeStatus/billing/{id}', [
		'as' => 'billing.changeStatus',
		'uses' => 'BillingController@changeStatus'
		]);

	Route::get('export/billing/{id}', [
		'as' => 'billing.exportPdf',
		'uses' => 'BillingController@exportPdf'
		]);
	Route::get('kirimEmail/billing/{id}', [
		'as' => 'billing.kirimEmail',
		'uses' => 'BillingController@kirimEmail'
		]);

	// Route::resource('user', 'UserController');
	Route::get('user', [
		'as' => 'user.index',
		'uses' => 'UserController@index'
		]);

	Route::get('user/create', [
		'as' => 'user.create',
		'uses' => 'UserController@create'
		]);
	Route::get('user/show/{user}', [
		'as' => 'user.show',
		'uses' => 'UserController@show'
		]);
	Route::post('user/store', [
		'as' => 'user.store',
		'uses' => 'UserController@store'
		]);
	Route::get('user/{user}/edit', [
		'as' => 'user.edit',
		'uses' => 'UserController@edit'
		]);
	Route::match(['put', 'patch'], 'user/update/{user}', [
		'as' => 'user.update',
		'uses' => 'UserController@update'
		]);
	Route::get('user/destroy/{id}', [
		'as' => 'user.destroy',
		'uses' => 'UserController@destroy'
		]);
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
	Route::get('visualstatic/showAll/{id}', [
		'as' => 'visualstatic.showAll',
		'uses' => 'VisualstaticController@showAll'
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
	Route::get('hydrostatic/showAll/{id}', [
		'as' => 'hydrostatic.showAll',
		'uses' => 'HydrostaticController@showAll'
		]);
	Route::get('hydrostatic/{hydrostatic}/edit', [
		'as' => 'hydrostatic.edit',
		'uses' => 'HydrostaticController@edit'
		]);
	// Route::get('hydrostatic/{hydrostatic}/editSingle', [
	// 	'as' => 'hydrostatic.editSingle',
	// 	'uses' => 'HydrostaticController@editSingle'
	// 	]);
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

	Route::get('template/hydrostatic/{id}', [
		'as' => 'hydrostatic.template',
		'uses' => 'HydrostaticController@generateExcelTemplate'
		]);
});