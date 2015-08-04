@extends('master_layout')
@section('content')
<center>
	@foreach($data["posts"] as $onePost)
		<h4><a href="./article/view/{{{$onePost["id"]}}}">{{{$onePost["title"]}}}</a></h4>
		<p>by: <a href="./user/{{{$onePost["author_id"]}}}/view_profile">{{{$onePost["author"]}}}</a></p>
		<p>{{{$onePost["body"]}}}</p>
	@endforeach
</center>
@stop
