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

// ログイン不要機能
Route::get('/', 'HomeController@index')->name('addon.index');
Route::get('show/{id}', 'HomeController@show')->name('addon.show');
Route::post('download/{id}', 'HomeController@download')->name('addon.download');

// ログイン
Auth::routes();

// ログイン必須機能
Route::post('upload', 'AddonController@upload')->name('addon.upload');
Route::get('input', 'AddonController@input')->name('addon.input');
Route::post('regist', 'AddonController@regist')->name('addon.regist');
Route::post('cancel', 'AddonController@cancel')->name('addon.cancel');

Route::get('manage', 'AddonController@manage')->name('addon.manage');
Route::get('delete/{id}', 'AddonController@delete')->name('addon.delete');

Route::get('admin/user', 'AdminController@user')->name('admin.user');
Route::get('admin/user/delete/{id}', 'AdminController@userDelete')->name('admin.user.delete');
Route::get('admin/addon', 'AdminController@addon')->name('admin.addon');
Route::get('admin/addon/delete/{id}', 'AdminController@addonDelete')->name('admin.addon.delete');
