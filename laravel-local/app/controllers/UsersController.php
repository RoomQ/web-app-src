<?php

class UsersController extends \BaseController {

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
		$users = $this->user->all();

		return View::make('users.index',['users' => $users]);
	}


	public function show($email)
	{
		$user = $this->user->whereEmail($email)->first();

		return View::make('users.show',['user' => $user]);
	}


	public function create()
	{

		return View::make('users.create');
	}

	public function store()
	{
		
		$input = Input::all();
		

		if (! $this->user->fill($input)->isValid(get_class($this)) ) {
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}
		
		$this->user->setPassword(Input::get('password'));
		unset($this->user->password_confirmation);
		$this->user->save();

		return Redirect::route('users.index');
	}

}
