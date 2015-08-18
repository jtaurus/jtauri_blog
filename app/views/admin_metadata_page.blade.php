@extends('master_layout')
@section('title')
Admin page - Change metadata
@stop
@section('content')
@if(isset($message))
{{$message}}
@endif
{{Form::open()}}
<div class="form-group">
{{Form::label('title', 'Page title');}}
{{Form::text('title', BlogConfig::getConfigValue('title'), array('class' => 'form-control'));}}
</div>
{{Form::submit('Submit', array('class' => 'btn btn-default'));}}
{{Form::close();}}
@stop