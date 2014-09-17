@extends('layouts.main')

@section('leftColumn')

        <div class="text-center">{{ link_to_route('admin.create', 'Add New User', array(), array('class' => 'button expand')) }}</div>

        <ul class="userlist">
            @foreach ($paginatedUsers as $pUser)
            @if($pUser->id == $user->id)
            <li class="current"> {{ $pUser->name }} </li>
            @else
            <li> {{ HTML::linkAction('AdminController@show', $pUser->name, array($pUser->id)) }} </li>
            @endif
            @endforeach
        </ul>

        {{ $paginatedUsers->links(array('class' => 'center')) }}

@stop

@section('welcome')
        <div class="row">
            <div class="large-12 columns">
            Welcome {{ Auth::user()->username }} {{ link_to_action('AuthController@getLogout', 'Logout', $parameters  = array(), $attributes = array('class' => 'button right')) }}
            </div>
        </div>
@stop

@section('adminButtons')
<div class="row">
    <ul class="large-offset-6 large-6 center columns large-block-grid-2 button-row">
        <li>{{ Form::open(array('method' => 'DELETE', 'route' => array('admin.destroy', $user->id))) }}
        {{ Form::submit('Delete', array('class' => 'button')) }}
            {{ Form::close() }}</li>
        <li> {{ link_to_route('admin.edit', 'Edit', array($user->id), array('class' => 'button')) }}</li>

    </ul>
</div>
@stop