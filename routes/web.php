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
    return view('auth.login');
});
Route::group(['middleware' => ['web']], function(){
//Route::get('provinces/{id}', 'provinceController@index');
Route::get('getdiocese/{id}', [
	'uses' => 'detailsController@diocese',
    'as' => 'diocesedetails',
    'middleware' => 'auth'
]);
//Route::get('getarchdeadonary/{id}', 'detailsController@archdeaconary')->name('diocesedetails');
Route::get('getparish/{id}', [
	'uses' =>'detailsController@parish',
	'as' =>'parishdetails',
	'middleware' => 'auth'
]);

Route::get('getpriest/{id}', [
	'uses' => 'detailsController@priest',
	'as'=>'priestdetails',
	'middleware' => 'auth'
]);
Route::get('payment', [
	'uses' => 'HomeController@payment',
	'as'=>'payment',
	'middleware' => 'auth'
]);
Route::post('updatepayment', [
	'uses' => 'HomeController@updatepayment',
	'as'=>'updatepayment',
	'middleware' => 'auth'
]);
Route::resource('provinces', 'provinceController');

Route::resource('profile', 'profileController');
Route::resource('view', 'viewprofileController');
Route::resource('priest', 'PriestController');
Route::resource('diocese', 'dioceseController');
Route::resource('parish', 'parishController');
Route::resource('archdeaconary', 'archdeaconaryController');
Route::resource('admin', 'adminController');
Route::resource('official', 'officialController');
Route::resource('church', 'churchController');

Auth::routes();
Route::post('editprovince', [
	'uses' =>'editController@editprovince', 
	'as' =>'editprovince',
	'middleware' =>'auth'
]);
Route::post('moveparish', [
	'uses' =>'editController@moveparish', 
	'as' =>'moveparish',
	'middleware' =>'auth'
]);
Route::post('editdiocese',[
	'uses' =>'editController@editdiocese',
	'as'=>'editdiocese',
	'middleware' => 'auth'

]);
Route::post('editarchdeaconary',[
	'uses'=>'editController@editarchdeaconary',
	'as'=>'editarchdeaconary',
	'middleware' => 'auth'
]);
Route::post('editparish',[
	'uses'=>'editController@editparish',
	'as'=>'editparish',
    'middleware' => 'auth'
]);
Route::post('deleteprovince',[
	'uses'=>'deleteController@deleteprovince',
	'as'=>'deleteprovince',
	'middleware' => 'auth'
]);
Route::post('deletediocese', [
	'uses'=>'deleteController@deletediocese',
	'as'=>'deletediocese',
	'middleware' => 'auth'
]);
Route::post('deletearchdeaconary', [
	'uses'=>'deleteController@deletearchdeaconary',
	'as'=>'deletearchdeaconary',
	'middleware' => 'auth'
]);
Route::post('deleteparish',[
	'uses'=>'deleteController@deleteparish',
	'as'=>'deleteparish',
	'middleware' => 'auth'
]);
Route::post('deletepriest',[
	'uses'=>'deleteController@deletepriest',
	'as'=>'deletepriest',
	'middleware' => 'auth'
]);
Route::get('showpriest',[
	'uses'=>'deleteController@showpriest',
	'as'=>'showpriest',
	'middleware' => 'auth'
]);
Route::get('editpriest',[
	'uses'=>'editController@editpriest',
	'as'=>'editpriest',
	'middleware' => 'auth'
]);
Route::get('addofficial',[
	'uses'=>'editController@addofficial',
	'as'=>'addofficial',
	'middleware' => 'auth'
]);
Route::get('editofficial',[
	'uses'=>'editController@editofficial',
	'as'=>'editofficial',
	'middleware' => 'auth'
]);
Route::post('savedpriestdata',[
	'uses'=>'editController@savedpriestdata',
	'as'=>'savedpriestdata',
	'middleware' => 'auth'
]);
Route::post('savedofficialdata',[
	'uses'=>'editController@savedofficialdata',
	'as'=>'savedofficialdata',
	'middleware' => 'auth'
]);
Route::post('savedaddofficialdata',[
	'uses'=>'editController@savedaddofficialdata',
	'as'=>'savedaddofficialdata',
	'middleware' => 'auth'
]);
Route::post('searchpriest',[
	'uses'=>'searchController@searchpriest',
	'as'=>'searchpriest',
	'middleware' => 'auth'
]);
Route::get('home', [
	'uses'=>'HomeController@index',
	'as'=>'home',
	'middleware' => 'auth'
]);
Route::get('viewprofile/{id}/{role}', [
	'uses'=>'viewController@index',
	'as'=>'profile',
	'middleware' => 'auth'
]);
Route::get('viewprofile/{profile_id}/{id}/{role}', [
	'uses'=>'viewController@priest',
	'as'=>'viewpriest',
	'middleware' => 'auth'
]);

});