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
Route::group([
  'prefix'=>'auth',

], function(){
	Route::post('login', 'apiController@login');
	Route::post('signup', 'apiController@signup');
	Route::post('getemail', 'apiController@getEmail');
	Route::post('reset', 'apiController@reset');
	//Route::post('signup', 'apiController@signup');
	Route::group([
     'middleware'=>'auth:api'
	], function(){
		Route::get('user', 'apiController@user');
	});
});
