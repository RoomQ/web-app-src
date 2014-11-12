@extends('layouts.default')

@section('breadcrumb')
	<li><a href="#">Home</a></li>
    <li class="active">Login</li>
@stop

@section('title')
	<title>RoomQ | Login</title>
@stop

@section('header')
	<h1>Login</h1>
@stop

@section('content')

	{{ Form::open(['route' => 'sessions.store']) }}
		<div class="form-group">
			{{ Form::label('email','Email') }}
			{{ Form::email('email','local_part@domain.com',['class' => 'form-control']) }}
			{{ $errors->first('email','<span class=error>:message</span>') }}
		</div>

		<div class="form-group">
			{{ Form::label('password','Password') }}
			{{ Form::password('password',['class' => 'form-control']) }}
			{{ $errors->first('password','<span class=error>:message</span>') }}
		</div>

		<div class="form-group clearfix">
			{{ Form::submit('Log In',['class' => 'btn pull-right btn-default']) }}
		</div>

		<hr/>
        <div class="center"><a href="#">I don't remember my password</a></div>

	{{ Form::close() }}

@stop