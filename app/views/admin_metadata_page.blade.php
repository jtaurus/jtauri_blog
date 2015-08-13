@extends('master_layout')
@section('title')
Admin page - Change metadata
@stop
@section('content')
@if(isset($message))
{{$message}}
@endif
Change title:
Can user post posts?
Can user edit posts?
Post moderation enabled?
@stop