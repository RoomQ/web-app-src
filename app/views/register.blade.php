<!doctype html>
<html>
<head>
	<title>Register</title>
</head>
<body>

	{{ Form::open(array('url' => 'login')) }}
		<h1>Register</h1>

		<!-- if there are login errors, show them here -->
		<p>
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
		</p>

		<p>
			{{ Form::label('name', 'Name') }}
			{{ Form::text('name') }}
		</p>

		<p>
			{{ Form::label('email', 'Email Address') }}
			{{ Form::email('email', Input::old('email'), array('placeholder' => 'awesome@awesome.com')) }}
		</p>

		<p>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
		</p>

		<p>{{ Form::submit('Submit!') }}</p>
	{{ Form::close() }}

</body>
</html>
