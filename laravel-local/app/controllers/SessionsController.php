<?php

class SessionsController extends \BaseController {

	protected $user;

	public function __construct(User $user){
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('sessions.index',['message' => $message]);
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
		$input = Input::only('email','password');

		if (! $this->user->fill($input)->isValid(get_class($this)) ) {
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}

		// attempt to do the login
		if ( Auth::attempt($input) ){
			return View::make('sessions.index')->withMessage('Welcome ' . Auth::user()->email);
		}
		return Redirect::back()->withInput();
	}

	public function destroy()
	{
		Auth::logout();
		return Redirect::route('sessions.create');
	}

}
