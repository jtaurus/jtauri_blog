@extends('master_layout')
@section('content')
<center>
	@foreach($data["posts"] as $onePost)
		<p><a href="./article/view/{{{$onePost["id"]}}}">{{{$onePost["title"]}}}</a></p>
		<p>by: <a href="./user/{{{$onePost["author_id"]}}}/view_profile">{{{$onePost["author"]}}}</a></p>
		<p>{{{$onePost["body"]}}}</p>
	@endforeach
</center>
@stop
