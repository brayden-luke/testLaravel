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
            return View::make('userindex');
});
Route::resource('users', 'UsersController');
Route::resource('login', 'UsersController@login');
Route::resource('register', 'UsersController@create');
Route::post('postregister', 'UsersController@postregister');
Route::post('postlogin', 'UsersController@postlogin');
Route::post('postedit', 'UsersController@postedit');
Route::resource('logout', 'UsersController@logout');






//Route::get('/', function()
//{
//	return View::make('hello');
//});