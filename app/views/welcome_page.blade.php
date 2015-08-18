@extends('master_layout')
@section('content')
<center>Welcome back, {{{$user->username}}}. <br /> Your e-mail address is: {{{$user->email}}}. <br /><a href="{{route('logout');}}">logout</a></center>
@stop


