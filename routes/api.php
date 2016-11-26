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

Route::post('login', 'AuthController@postLogin');
Route::post('register', 'AuthController@postRegister');
Route::get('logout', 'AuthController@getLogout');

Route::group(['prefix' => 'phone', 'middleware' => 'auth:api'], function() {
  Route::get('index', 'PhoneController@index');
  Route::post('create', 'PhoneController@create');
  Route::get('show/{id}', 'PhoneController@show');
  Route::post('update', 'PhoneController@update');
  Route::get('delete/{id}', 'PhoneController@delete');
});
