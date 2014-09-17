@extends('layouts.main')

@section('leftColumn')
<div style="height:2em;"></div>
        <ul class="userlist">
            @foreach ($paginatedUsers as $pUser)
            @if($pUser->id == $user->id)
            <li class="current"> {{ $pUser->name }} </li>
            @else
            <li> {{ link_to_route('guest.show', $pUser->name, $parameters = array($pUser->id), $attributes = array()) }}</li>
            @endif
            @endforeach
        </ul>

        {{ $paginatedUsers->links(array('class' => 'center')) }}

@stop

@section('welcome')
<div class="row">
    <div class="large-12 columns">
        Welcome Guest {{ link_to_action('AuthController@getLogin', 'Login', $parameters  = array(), $attributes = array('class' => 'button right')) }}
    </div>
</div>
@stop