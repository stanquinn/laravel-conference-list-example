@extends('layouts.modal')

@section('main')
<div class="row">
    <div class="large-12 columns">
        <h1>Edit Guest</h1>

        {{ Form::model($user, array('method' => 'PATCH', 'route' => array('admin.update', $user->id))) }}

        <ul>
            <li>
                {{ Form::label('username', 'Username:') }}
                {{ Form::text('username') }}
            </li>
            <li>
                {{ Form::label('password', 'Password:') }}
                {{ Form::text('password') }}
            </li>
            <li>
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name') }}
            </li>
            <li>
                {{ Form::label('email', 'Email:') }}
                {{ Form::text('email') }}
            </li>
            <li>
                {{ Form::label('company_name', 'Company:') }}
                {{ Form::text('company_name') }}
            </li>
            <li>
                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title') }}
            </li>
            <li>
                {{ Form::label('phone', 'Phone:') }}
                {{ Form::text('phone') }}
            </li>
            <li>
                {{ Form::label('address', 'Address:') }}
                {{ Form::text('address') }}
            </li>
            <li>
                {{ Form::label('city', 'City:') }}
                {{ Form::text('city') }}
            </li>
            <li>
                {{ Form::label('state', 'State:') }}
                {{ Form::text('state') }}
            </li>
            <li>
                {{ Form::label('zip', 'zip:') }}
                {{ Form::text('zip') }}
            </li>
            <li>
                {{ Form::label('dob', 'DOB:') }}
                {{ Form::text('dob' , $user->dob,  array('id' => 'datepicker', 'placeholder'=>'Date of Birth'))}}
            </li>
            <li>
                {{ Form::submit('Update', array('class' => 'button')) }}
                {{ link_to_route('admin.show', 'Cancel', $user->id, array('class' => 'button')) }}
            </li>
        </ul>
        {{ Form::close() }}

        @if ($errors->any())
        <ul>
            {{ implode('', $errors->all('
            <li class="error">:message</li>
            ')) }}
        </ul>
        @endif
    </div>
</div>
@stop

@section('scripts')
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script type="text/JavaScript">

    $(document).ready(function () {

        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:-10"

        });

    });

</script>
@stop