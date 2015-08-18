@extends('master_layout')
@section('title')
Blog
@stop
@section('content')
<center>
	<div class="col-sm-3">
	<div class="thumbnail text-center">
		<center><h3>Latest posts:</h3></center>
		<ul>
		@foreach($data["sidebar_links"] as $oneLink)
			<li class="text-left"><a href="./article/view/{{{$oneLink->id}}}">{{{$oneLink->title}}}</a> </li>
		@endforeach
		</ul>
	</div>
		<div class="thumbnail text-center">
		<center><h3>Categories:</h3></center>
		<ul>
			@foreach($data["category_links"] as $oneLink)
			<li class="text-left"><a href="{{route('category_page', $oneLink->id)}}">{{$oneLink->category_name}}</a></li>
			@endforeach
		</ul>
	</div>
</div>

	<div class="col-sm-9">
		<div>
	@foreach($data["posts"] as $onePost)
	<div class="page-header">
  	<h1 class="text-left"><a href="./article/view/{{{$onePost->id}}}">{{{$onePost->title}}}</a> </h1>
  	<br /><h3 class="text-right"><small>by: <a href="./user/{{{$onePost->user()->first()->id}}}/view_profile">{{{$onePost->user()->first()->username}}}</a></small></h3>
	</div>
		<div class="text-left">{{$onePost->body}}</div>
	@endforeach
		</div>
	</div>
	{{$data["posts"]->links()}}
</center>
@stop
