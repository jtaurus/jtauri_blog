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
		<center><h3><a href="{{route('view_article', $onePost["id"]);}}">{{{$onePost["title"]}}}</a></h3> on {{{$onePost["post_date"]}}} <br />
		{{$onePost["body"]}} <br /></center>
	@endforeach
@else
	No posts to show.
@endif
<h1>Latest comments:</h1><br />
	<center>
@if(count($data["comments"]) > 0)
	@foreach($data["comments"] as $oneComment)
		<center><h3><a href="/simple_blog/public/article/view/{{{$oneComment["commented_post_id"]}}}">{{{$oneComment["commented_post_title"]}}}</a></h3> on {{{$oneComment["comment_post_date"]}}} <br />
			<p>{{{$oneComment["body"]}}}</p>
	@endforeach
@else
	No comments to show.
@endif
	</center>
@stop