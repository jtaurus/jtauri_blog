@extends('master_layout')
@section('content')
<center>Article title: {{{$data["title"]}}}<br /><br />
Article body:{{{$data["body"]}}}<br /><br />
Comments:
@foreach ($data["detailed_comments"] as $oneComment)
	<p>{{{$oneComment["body_comment"] }}} posted on {{{$oneComment["created_at"]}}} by: <a href="/simple_blog/public/user/{{{$oneComment["author_id"]}}}/view_profile">{{{$oneComment["author"]}}}</a></p>
@endforeach
<br /><br />
<a href="./{{{$data["id"]}}}/comment">Add comment to this article</a>
@stop