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

Route::get('admin', function () {
    return view('admin_template');
})
->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//Country ROUTES
//Route::get('/get/Country','CountryController@getCountry') ->name('Country.getCountry') ->middleware('auth');

//Country Controller
Route::resource('countries', 'CountryController');
//Location Controller
Route::resource('locations', 'LocationController');

//StatusController
Route::resource('statuses', 'StatusController');

Route::resource('people', 'PersonController');

Route::resource('categories', 'CategoryController');
/*Route::get('people', 'PersonController@getIndex')->name('people'); */

/*Route::get('people.data', 'PersonController@personData')->name('people.data');*/

//Route::resource('assetsubtypes', 'AssetSubTypesController');
//Route::post('assetsubtypes/search', 'AssetSubTypesController@search')->name('assetsubtypes.search');

//Route::resource('cyclephases', 'CyclePhasesController');
//Route::post('cyclephases/search', 'CyclePhasesController@search')->name('cyclephases.search');

Route::resource('assettypes', 'AssetTypesController');
Route::post('assettypes/search', 'AssetTypesController@search')->name('assettypes.search');

//Route::resource('system-management/assettypes', 'AssetTypesController');
//Route::post('system-management/assettypes/search', 'AssetTypesController@search')->name('assettypes.search');

Route::resource('system-management/cyclephases', 'CyclePhasesController');
Route::post('system-management/cyclephases/search', 'CyclePhasesController@search')->name('cyclephases.search');

Route::resource('system-management/assetsubtypes', 'AssetSubTypesController');
Route::post('system-management/assetsubtypes/search', 'AssetSubTypesController@search')->name('assetsubtypes.search');

Route::resource('system-management/locations', 'LocationController');
Route::post('system-management/locations/search', 'LocationController@search')->name('locations.search');