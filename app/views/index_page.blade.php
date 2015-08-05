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
		@foreach($data["posts"] as $onePost)
			<li class="text-left"><a href="./article/view/{{{$onePost["id"]}}}">{{{$onePost["title"]}}}</a> </li>
		@endforeach
		</ul>
	</div>
</div>

	<div class="col-sm-9">
	@foreach($data["posts"] as $onePost)
	<div class="page-header">
  	<h1 class="text-left"><a href="./article/view/{{{$onePost["id"]}}}">{{{$onePost["title"]}}}</a> </h1>
  	<br /><h3 class="text-right"><small>by: <a href="./user/{{{$onePost["author_id"]}}}/view_profile">{{{$onePost["author"]}}}</a></small></h3>
	</div>
		<p >{{$onePost["body"]}}</p>
	@endforeach
	</div>
</center>
@stop
