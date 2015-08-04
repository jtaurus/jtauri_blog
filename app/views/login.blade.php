@extends('master_layout')
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