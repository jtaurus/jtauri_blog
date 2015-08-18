@extends('master_layout')
@section('title')
{{{$data["user"]->username}}} user profile
@stop
@section('content')
Username: {{{$data["user"]->username}}}<br />
E-mail: {{{$data["user"]->email}}}<br />
Registration date: {{{$data["user"]->created_at}}}<br />
<h1>Latest posts:</h1><br />
@if(count($data["posts"]) > 0)
	@foreach($data["posts"] as $onePost)
		<div class ="text-left"><h3><a href="{{route('view_article', $onePost->id);}}">{{{$onePost->title}}}</a></h3> on {{{$onePost->created_at}}}</div> <br />
		<div class ="text-left">{{$onePost->body}}</div> <br /></center>
	@endforeach
@else
	No posts to show.
@endif
<h1>Latest comments:</h1><br />
	<center>
@if(count($data["comments"]) > 0)
	@foreach($data["comments"] as $oneComment)
		<div class ="text-left"><h3><a href="{{route('view_article', $oneComment->post()->first()->id);}}">{{{$oneComment->post()->first()->title}}}</a></h3> on {{{$oneComment->post()->first()->created_at}}}</div> <br />
			<div class ="text-left">{{{$oneComment->body_comment}}}</div>
	@endforeach
@else
	No comments to show.
@endif
	</center>
@stop