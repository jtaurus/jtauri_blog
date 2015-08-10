@extends('master_layout')
@section('title')
Admin page - Manage users
@stop
@section('content')
<h3 class="text-left">Users:</h3>
@foreach($data["users"] as $oneUser)
	<p><a href="{{route('user_profile', $oneUser->id)}}">{{$oneUser->username}}</a></p>
@endforeach
@stop