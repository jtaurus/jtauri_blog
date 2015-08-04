@extends('master_layout')
@section('content')
Username: {{{$data["username"]}}}<br />
E-mail: {{{$data["email"]}}}<br />
Registration date: {{{$data["registration_date"]}}}<br />
<h1>Latest posts:</h1><br />
@foreach($data["posts"] as $onePost)
	<center><h3><a href="/simple_blog/public/article/view/{{{$onePost["id"]}}}">{{{$onePost["title"]}}}</a></h3> on {{{$onePost["post_date"]}}} <br />
	{{{$onePost["body"]}}} <br /></center>
@endforeach
<h1>Latest comments:</h1><br />
	<center>
@foreach($data["comments"] as $oneComment)
	<center><h3><a href="/simple_blog/public/article/view/{{{$oneComment["commented_post_id"]}}}">{{{$oneComment["commented_post_title"]}}}</a></h3> on {{{$oneComment["comment_post_date"]}}} <br />
		<p>{{{$oneComment["body"]}}}</p>
@endforeach
	</center>
@stop