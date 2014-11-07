<?php

class SessionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	
	}


	public function show($username)
	{
	
	}


	public function create()
	{
		if( Auth::check() ){
			return Redirect::to('/admin');
		}
		return View::make('sessions.create');

	}

	public function store()
	{
		// attempt to do the login
		if ( Auth::attempt(Input::only('email','password')) ){
			return 'Welcome ' . Auth::user()->email;
		}
		return Redirect::back()->withInput();
	}

	public function destroy()
	{
		Auth::logout();
		return Redirect::route('sessions.create');
	}

}
