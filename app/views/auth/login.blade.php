@extends('layouts.modal')

@section('main')
@if (Session::has('message'))
<div class="flash alert">
    <p>{{ Session::get('message') }}</p>
</div>
@endif
{{ Form::open(array('url'=>'auth/signin', 'class'=>'form-signin')) }}
	<h2 class="form-signin-heading">Please Login</h2>

	{{ Form::text('username', null, array('class'=>'input-block-level', 'placeholder'=>'Username')) }}
	{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}

	{{ Form::submit('Login', array('class'=>'button'))}}
{{ Form::close() }}
@stop