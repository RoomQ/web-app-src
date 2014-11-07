@extends('layouts.default')
@section('content')

	<h1>Logged In?</h1>

	@if ( Auth::check() )
		<p><b>User logged in successfully...</b></p>
		<p>{{ $message }}</p>
	@else
		<p><b>User log in failed...</b></p>
		<p>Unfortunately there were no logged in users</p>
	@endif
@stop