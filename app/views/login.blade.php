@extends('master_layout')
@section('title')
Login page
@stop
@section('content')
	{{{$message or ""}}}
	<br /><br />
	{{Form::open( array('class' => 'form-inline'));}}
	<div class="form-group">
	{{Form::label('username', 'Username')}}
	{{Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username'));}}
	</div>
	<div class="form-group">
	{{Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password'));}}
	</div>
	{{Form::submit('Log in', array('class' => 'btn btn-default'));}}
	{{Form::close();}}
@stop
