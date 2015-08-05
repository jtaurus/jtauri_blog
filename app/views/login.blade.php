@extends('master_layout')
@section('title')
Login page
@stop
@section('content')
	{{{$message or ""}}}
	<br /><br />
	{{Form::open();}}
	{{Form::text('username', 'username');}}
	<br />
	{{Form::password('password');}}
	<br />
	{{Form::submit('Log in');}}
	{{Form::close();}}
@stop