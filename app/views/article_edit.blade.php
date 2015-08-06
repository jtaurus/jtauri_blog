@extends('master_layout')
@section('title')
Edit article
@stop
@section('head')
{{HTML::script("resources/ckeditor/ckeditor.js")}}
@stop
@section('content')
@if(Auth::check())
<center>Welcome, {{{Auth::user()->username}}}. Use the form below to edit this article.</center> <br />
@endif
@if(isset($message))
	<center><h2>{{$message}}</h2></center>
@endif
{{Form::open();}}
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">Title</span>
{{Form::text('title', $data["post_title"], array('class' => 'form-control', 'aria-describedby' => 'basic-addon1'));}}<br />
</div>
{{Form::textarea('body', $data["post_body"]);}}<br />
            <script>
                CKEDITOR.replace( 'body' );
            </script>
{{Form::submit();}}
{{Form::close();}}
@stop
