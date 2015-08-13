@extends('master_layout')
@section('title')
{{{$data["title"]}}}
@stop
@section('content')
@if(Auth::check() && Auth::user()->username == $data["author"] || Auth::check() && Auth::user()->isAdmin())
<div class="text-right"><a href="../edit/{{$data["id"]}}">Edit this article</a> | <a href="../delete/{{$data["id"]}}">Delete</a></div>
@endif
<h1>{{{$data["title"]}}}</h1>
<div class="text-left">Posted by <a href="{{route('user_profile', $data["author_id"])}}">{{$data["author"]}}</a> in <a href="{{route('category_page', $data["category_id"])}}">{{$data["category_name"]}}</a></div>
<p>{{ $data["body"] }}</p><br /><br />
<a href="{{route('comment_article', $data["id"]);}}">Add comment to this article</a>
<h3>Comments:</h3>
@foreach ($data["detailed_comments"] as $oneComment)
	<div class="text-right"> posted on {{{$oneComment["created_at"]}}} by: <a href="{{route('user_profile', $oneComment["author_id"]);}}">{{{$oneComment["author"]}}}</a></div>
	@if(Auth::check() && Auth::user()->username == $oneComment["author"] || Auth::check() && Auth::user()->isAdmin())
		<div class="text-right"><a href="{{route('delete_comment', array('article_id' => $data["id"], 'comment_id' => $oneComment["id"]));}}">delete</a></div>
	@endif
	<div class="well" class="text-left">{{{$oneComment["body_comment"] }}}</div>
@endforeach
<center>{{$data["pagination_links"]}}</center>
@stop