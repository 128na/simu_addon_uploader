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

Route::prefix('v1')->group(function () {
  Route::get('/', 'Api\V1Controller@index');
  Route::get('/search', 'Api\V1Controller@search');
  Route::get('/{id}', 'Api\V1Controller@show');
});
