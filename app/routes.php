<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
            return View::make('dataindex');
});
Route::resource('data', 'DataController');
Route::resource('alldata', 'DataController@showall');
Route::resource('register', 'DataController@create');
Route::post('postregister', 'DataController@postregister');
Route::post('postlogin', 'DataController@postlogin');
Route::post('postedit', 'DataController@postedit');
Route::resource('logout', 'DataController@logout');
Route::get('editdata/{id}', 'DataController@editdata');
Route::get('delete/{id}','DataController@deletedata');






//Route::get('/', function()
//{
//	return View::make('hello');
//});