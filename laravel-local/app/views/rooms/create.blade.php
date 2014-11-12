@extends('layouts.default')

@section('breadcrumb')
	<li><a href="#">Home</a></li>
    <li class="active">Rooms</li>
@stop

@section('title')
	<title>RoomQ | Rooms</title>
@stop

@section('header')
	<h1>Rooms</h1>
@stop

@section('content')

	{{ Form::open(['route' => 'rooms.store']) }}
		<div class="form-group">
			{{ Form::label('title','Title') }}
			{{ Form::text('title','Please type in a title containing main keywords that describe the room to let',['class' => 'form-control']) }}
			{{ $errors->first('title','<span class=error>:message</span>') }}
		</div>

		<div class="form-group">
			{{ Form::label('description','Description') }}
			{{ Form::text('description','Please type in a complete description of the room properties',['class' => 'form-control']) }}
			{{ $errors->first('description','<span class=error>:message</span>') }}
		</div>

		<div class="form-group">
			{{ Form::label('bed_no','Bed number') }}
			{{ Form::selectRange('bed_no', 10, 20,['class' => 'form-control']) }}
			{{ $errors->first('bed_no','<span class=error>:message</span>') }}
		</div>

		<div class="form-group clearfix">
			{{ Form::submit('Create Room',['class' => 'btn pull-right btn-default']) }}
		</div>

	{{ Form::close() }}

@stop