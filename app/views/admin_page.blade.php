@extends('master_layout')
@section('title')
Admin page
@stop
@section('content')
<h4 class="text-left"><a href="{{route('manage_users')}}">Manage users</a></h4>
<h3 class="text-left">Unmoderated posts</h3>
@foreach($data["unmoderated"] as $onePost)
<p><a href="{{route('view_article', $onePost->id)}}">{{$onePost->title}}</a> by <a href="{{route('user_profile', $onePost->user()->first()->id)}}">{{$onePost->user()->first()->username}}</a> </p> <br />
@endforach
<h3 class="text-left">Recent posts</h3>
@foreach($data["posts"] as $onePost)
<p><a href="{{route('view_article', $onePost->id)}}">{{$onePost->title}}</a> by <a href="{{route('user_profile', $onePost->user()->first()->id)}}">{{$onePost->user()->first()->username}}</a> </p> <br />
@endforeach
<h3 class="text-left">Recent comments</h3>
@foreach($data["comments"] as $oneComment)
<p>Comment for article: <a href="{{route('view_article', $oneComment->post()->first()->id)}}">{{$oneComment->post()->first()->title}}</a></p>
<div class="text-center">{{$oneComment->body_comment}}</div>
@endforeach
@stop