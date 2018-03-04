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
Route::get('/test', function() {
  return view('welcome');
});
Route::get('/', 'AddonController@index')->name('addon.index');
Route::post('upload', 'AddonController@upload')->name('addon.upload');
Route::post('input', 'AddonController@input')->name('addon.input');
Route::get('show/{id}', 'AddonController@show')->name('addon.show');