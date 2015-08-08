@extends('master_layout')
@section('title')
View category - {{$data["category_name"]}}
@stop
@section('content')
<center>
	<h3 class="text-left">Viewing posts in category: {{$data["category_name"]}}</h3>
	<div class="col-sm-9">
		<div>
	@foreach($data["posts"] as $onePost)
	<div class="page-header">
  	<h3 class="text-left"><a href="{{route('view_article', $onePost["id"])}}">{{{$onePost["title"]}}}</a> </h3>
  	<br /><h3 class="text-right"><small>by: <a href="{{route('user_profile', $onePost["author_id"])}}">{{{$onePost["author"]}}}</a></small></h3>
	</div>
		<div class="text-left">{{$onePost["body"]}}</div>
	@endforeach
		</div>
	</div>
	{{$data["posts"]->links()}}
</center>
@stop
