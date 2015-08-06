@extends('master_layout')
@section('title')
Create a new account
@stop
@section('content')
<center>Create a new account</center>

{{Form::open();}}
<div class="form-group">
{{Form::label('username', 'Username');}}
{{Form::text('username', 'username', array('class' => 'form-control'));}}
</div>
<div class="form-group">
{{Form::label('email', 'E-mail')}}
{{Form::text('email', 'email', array('class' => 'form-control', 'type' => 'email', 'placeholder' => 'email'));}}
</div>
<div class="form-group">
{{Form::label('password', 'Password');}}
{{Form::password('password', array('class' => 'form-control'));}}
</div>
<br />
{{Form::submit('Submit', array('class' => 'btn btn-default'));}}
{{Form::close();}}
<br />
{{{$message or ""}}}
@stop
