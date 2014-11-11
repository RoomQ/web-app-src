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

Route::get('/', function()
{
	return View::make('index');
});


Route::get('phpinfo', function()
{
    phpinfo();
});

Route::resource('users', 'UsersController');
Route::resource('sessions', 'SessionsController');
Route::resource('rooms', 'RoomsController');

Route::get('login', 'SessionsController@create');
Route::get('register', 'UsersController@create');
Route::get('logout', 'SessionsController@destroy');