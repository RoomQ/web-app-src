@extends('layouts.default')
@section('content')

	<div class="page-header">
		<h1><span class="glyphicon glyphicon-flash"></span>Register</h1>
	</div>

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

		<div>
			{{ Form::submit('Register',['class' => 'btn btn-success']) }}
		</div>

	{{ Form::close() }}

@stop