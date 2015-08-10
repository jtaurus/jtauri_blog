@extends('master_layout')
@section('title')
Admin page
@stop
@section('content')
<h3 class="text-left">Recent posts</h3>
@foreach($data["posts"] as $onePost)
<p><a href="{{route('view_article', $onePost->id)}}">{{$onePost->title}}</a> by <a href="{{route('user_profile', $onePost->user()->first()->id)}}">{{$onePost->user()->first()->username}}</a> </p> <br />
@endforeach
@stop