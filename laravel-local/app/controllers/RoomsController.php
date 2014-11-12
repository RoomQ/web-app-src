<?php

class RoomsController extends \BaseController {

	protected $room;

	public function __construct(Room $room){
		$this->room = $room;
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
		return View::make('rooms.create');

	}

	public function store()
	{
		return 'Nothingness';
	}

	public function destroy()
	{
		Auth::logout();
		return Redirect::route('sessions.create');
	}

}
