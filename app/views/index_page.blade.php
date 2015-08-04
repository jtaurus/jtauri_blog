@extends('master_layout')
@section('content')
<center>
	@foreach($data["posts"] as $onePost)
	<div class="page-header">
  <h1><a href="./article/view/{{{$onePost["id"]}}}">{{{$onePost["title"]}}}</a> 
  	<br /><small>by: <a href="./user/{{{$onePost["author_id"]}}}/view_profile">{{{$onePost["author"]}}}</a></small></h1>
</div>
		<div class="well">{{{$onePost["body"]}}}</div>
	@endforeach
</center>
@stop
