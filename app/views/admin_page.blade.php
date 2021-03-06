@extends('master_layout')
@section('title')
Admin page
@stop
@section('content')
<h4 class="text-left"><a href="{{route('manage_users')}}">Manage users</a></h4>
<h3 class="text-left">Unmoderated posts</h3>
@if(isset($data["unmoderated"]))
@foreach($data["unmoderated"] as $onePost)
<p><a href="{{route('view_article', $onePost->id)}}">{{$onePost->title}}</a> by <a href="{{route('user_profile', $onePost->user()->first()->id)}}">{{$onePost->user()->first()->username}}</a> - <a href="{{route('accept_a_post', $onePost->id)}}">Accept a post</a> | <a href="{{route('delete_article', $onePost->id)}}">Reject</a></p> <br />
@endforeach
@endif
<h3 class="text-left">Recent posts</h3>
@if(isset($data["posts"]))
@foreach($data["posts"] as $onePost)
<p><a href="{{route('view_article', $onePost->id)}}">{{$onePost->title}}</a> by <a href="{{route('user_profile', $onePost->user()->first()->id)}}">{{$onePost->user()->first()->username}}</a> </p> <br />
@endforeach
@endif
<h3 class="text-left">Recent comments</h3>
@if(isset($data["comments"]))
@foreach($data["comments"] as $oneComment)
<p>Comment for article: <a href="{{route('view_article', $oneComment->post()->first()->id)}}">{{$oneComment->post()->first()->title}}</a></p>
<div class="text-center">{{$oneComment->body_comment}}</div>
@endforeach
@endif
@stop