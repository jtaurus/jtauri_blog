@extends('master_layout')
@section('title')
Comment article
@stop
@section('content')
<center>
<div class ="text-left">
{{$article->body}}
</div>
<br /><br />
{{Form::open();}}
{{Form::textarea('comment_body', '', array('class' => 'form-control', 'rows' => '3'));}}
<br />
{{Form::submit('Post comment', array('class' => 'btn btn-default'));}}
{{Form::close();}}
</center>
@stop
