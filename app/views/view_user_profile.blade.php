@extends('master_layout')
@section('title')
{{{$data["username"]}}} user profile
@stop
@section('content')
Username: {{{$data["username"]}}}<br />
E-mail: {{{$data["email"]}}}<br />
Registration date: {{{$data["registration_date"]}}}<br />
<h1>Latest posts:</h1><br />
@if(count($data["posts"]) > 0)
	@foreach($data["posts"] as $onePost)
		<div class ="text-left"><h3><a href="{{route('view_article', $onePost["id"]);}}">{{{$onePost["title"]}}}</a></h3> on {{{$onePost["post_date"]}}}</div> <br />
		<div class ="text-left">{{$onePost["body"]}}</div> <br /></center>
	@endforeach
@else
	No posts to show.
@endif
<h1>Latest comments:</h1><br />
	<center>
@if(count($data["comments"]) > 0)
	@foreach($data["comments"] as $oneComment)
		<div class ="text-left"><h3><a href="{{route('view_article', $oneComment["commented_post_id"]);}}">{{{$oneComment["commented_post_title"]}}}</a></h3> on {{{$oneComment["comment_post_date"]}}}</div> <br />
			<div class ="text-left">{{{$oneComment["body"]}}}</div>
	@endforeach
@else
	No comments to show.
@endif
	</center>
@stop