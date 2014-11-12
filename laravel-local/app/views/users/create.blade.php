@extends('layouts.default')

@section('breadcrumb')
	<li><a href="#">Home</a></li>
    <li class="active">Register</li>
@stop

@section('title')
	<title>RoomQ | Register</title>
@stop

@section('header')
	<h1>Register</h1>
@stop

@section('content')

	{{ Form::open(['route' => 'users.store']) }}
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

		<div class="form-group">
			{{ Form::label('password_confirmation','Re-Type Password') }}
			{{ Form::password('password_confirmation',['class' => 'form-control']) }}
			{{ $errors->first('password_confirmation','<span class=error>:message</span>') }}
		</div>

		<div class="form-group clearfix">
			{{ Form::submit('Register',['class' => 'btn pull-right btn-default']) }}
		</div>

	{{ Form::close() }}

@stop