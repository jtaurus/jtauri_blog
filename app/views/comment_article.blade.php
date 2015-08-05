@extends('master_layout')
@section('title')
Comment article
@stop
@section('content')
<center>
{{{$article}}}
<br /><br />
{{Form::open();}}
{{Form::textarea('comment_body', '');}}
<br />
{{Form::submit();}}
{{Form::close();}}
</center>
@stop