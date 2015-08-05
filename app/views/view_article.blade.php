@extends('master_layout')
@section('content')
<h1>{{{$data["title"]}}}</h1><br /><br />
<p>{{$data["body"]}}</p><br /><br />
<a href="./{{{$data["id"]}}}/comment">Add comment to this article</a>
<h3>Comments:</h3>
@foreach ($data["detailed_comments"] as $oneComment)
	<p class="text-left">{{{$oneComment["body_comment"] }}}</p>
	<p class="text-right"> posted on {{{$oneComment["created_at"]}}} by: <a href="/simple_blog/public/user/{{{$oneComment["author_id"]}}}/view_profile">{{{$oneComment["author"]}}}</a></p>
@endforeach
<br /><br />
@stop