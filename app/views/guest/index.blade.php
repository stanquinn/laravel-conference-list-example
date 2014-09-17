@extends('layouts.main')

@section('leftColumn')

<ul class="userlist">
    @foreach ($users as $user)
    <!--li> {{ HTML::linkAction('AdminController@show', $user->name, array($user->id)) }} </li-->
    <li> {{ link_to('guest/show', $user->name, array($user->id), null) }} </li>
    @endforeach
</ul>

@stop

@section('welcome')
<div class="row">
    <div class="large-12 columns">
        Welcome Guest {{ link_to_action('AuthController@getLogin', 'Login', $parameters  = array(), $attributes = array('class' => 'button right')) }}
    </div>
</div>
@stop

@section('adminButtons')
@stop