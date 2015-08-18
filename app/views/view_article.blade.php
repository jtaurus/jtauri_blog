@extends('master_layout')
@section('title')
{{{$data["post"]->title}}}
@stop
@section('content')
@if(Auth::check() && Auth::user()->username == $data["author"]->username || Auth::check() && Auth::user()->isAdmin())
@if(BlogConfig::getConfigValue('user_can_edit_posts'))
<div class="text-right"><a href="../edit/{{$data["post"]->id}}">Edit this article</a> | <a href="../delete/{{$data["post"]->id}}">Delete</a></div>
@endif
@endif
<h1>{{{$data["post"]->title}}}</h1>
@if(!$data["post"]->moderated)
<div class="text-left">This post has not been yet moderated.</div><br />
@endif
<div class="text-left">Posted by <a href="{{route('user_profile', $data["author"]->id)}}">{{$data["author"]->username}}</a> in <a href="{{route('category_page', $data["category"]->id)}}">{{$data["category"]->category_name}}</a></div>
<p>{{ $data["post"]->body }}</p><br /><br />
<a href="{{route('comment_article', $data["post"]->id);}}">Add comment to this article</a>
<h3>Comments:</h3>
@foreach ($data["comments"] as $oneComment)
	<div class="text-right"> posted on {{{$oneComment->created_at}}} by: <a href="{{route('user_profile', $oneComment->user()->first()->id);}}">{{{$oneComment->user()->first()->username}}}</a></div>
	@if(Auth::check() && Auth::user()->username == $oneComment->user()->first()->username || Auth::check() && Auth::user()->isAdmin())
		<div class="text-right"><a href="{{route('delete_comment', array('article_id' => $data["post"]->id, 'comment_id' => $oneComment->id));}}">delete</a></div>
	@endif
	<div class="well" class="text-left">{{{$oneComment->body_comment }}}</div>
@endforeach
<center>{{$data["comments"]->links()}}</center>
@stop