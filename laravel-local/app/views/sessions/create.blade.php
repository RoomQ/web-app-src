@extends('layouts.default')
@section('content')

	<h1>Login</h1>

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

		<div>
			{{ Form::submit('Log In',['class' => 'btn btn-success']) }}
		</div>

	{{ Form::close() }}

@stop