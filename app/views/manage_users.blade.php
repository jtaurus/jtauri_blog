@extends('master_layout')
@section('title')
Admin page - Manage users
@stop
@section('content')
@if(isset($message))
{{$message}}
@endif
<h3 class="text-left">Users:</h3>
@foreach($data["users"] as $oneUser)
	<p><a href="{{route('user_profile', $oneUser->id)}}">{{$oneUser->username}}</a> - <a href="{{route('ban_user', $oneUser->id)}}">Ban user</a> || <a href="{{route('make_user_an_admin', $oneUser->id)}}">Make user an admin</a></p>
@endforeach
@stop