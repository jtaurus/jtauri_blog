@extends('master_layout')
@section('content')
You have been logged out. <a href="{{route('logout');}}">Log in</a>.<br />
<a href="{{{$data}}}">Go back to where you were</a>
@stop