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


/*Route::get('/', function()
{
    return "Welcome Home";
});
*/
Route::get('login', function()
{
    return View::make('loginForm');
});

Route::get('admin', function()
{
    return View::make('adminPage');
});

// route to show the login form
Route::get('login', array('uses' => 'LoginController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'LoginController@doLogin'));

// route for logging out
Route::get('logout', array('uses' => 'HomeController@doLogout'));

// route to show the registration form
Route::get('register', array('uses' => 'HomeController@showRegister'));
