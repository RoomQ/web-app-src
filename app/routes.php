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
	return View::make('hello');
});

Route::get('test', function()
{
	$name='Kyriakos Too';
    return View::make('test')->with('my_name',$name);
});

Route::get('users2', function()
{
    return View::make('users');
});

Route::get('usersCtrl', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('db', function(){
	$users = DB::table('users')->where('username','!=','JeffreyWay')->get();
	$user = DB::table('users')->find(1);

	return $users;
});
