@extends('master_layout')
@section('title')
Post a new article
@stop
@section('head')
{{HTML::script("resources/ckeditor/ckeditor.js")}}
@stop
@section('content')
<center>Welcome, {{{$username}}}. Use the form below to post a new article.</center> <br />
{{Form::open();}}
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">Title</span>
{{Form::text('title', null, array('class' => 'form-control', 'aria-describedby' => 'basic-addon1'));}}<br />
</div>
{{Form::textarea('body', null);}}<br />
            <script>
                CKEDITOR.replace( 'body' );
            </script>
{{Form::submit();}}
{{Form::close();}}
@stop
