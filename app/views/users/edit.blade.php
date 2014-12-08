@extends('layouts.master')

@section('content')
<h1>Edit user</h1>
{{ Form::model($user, array('url' => "users/$user->id", 'method' => 'PATCH'))}}

@include('partials/user-form-fields')

{{ Form::submit('Save changes', ['class' => 'btn btn-success btn-large form-control']) }}
{{ link_to(URL::previous(), 'Cancel', array('class' => 'btn btn-large bnt-default form-control'))}}

{{ Form::close() }}
@stop