@extends('master_layout')
@section('content')
<center>Create a new account</center>
{{Form::open();}}
{{Form::text('username', 'username');}}
<br />
{{Form::text('email', 'email');}}
<br />
{{Form::password('password');}}
<br />
{{Form::submit();}}
{{Form::close();}}
<br />
{{{$message or ""}}}
@stop
