@extends('master_layout')
@section('content')
<center>Welcome, {{{$username}}}. Use the form below to post a new article.</center> <br />
{{Form::open();}}
{{Form::text('title', 'Enter the title of the article here');}}<br />
{{Form::textarea('body', '');}}<br />
{{Form::submit();}}
{{Form::close();}}
@stop
