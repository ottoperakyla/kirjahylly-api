@extends('layouts.master')

@section('content')
	<h1>Login</h1>
	{{ Form::open(array('action' => array('UsersController@attemptLogin'), 'method' => 'post')) }}
		{{ Form::text('username', '', array('class' => 'form-control', 'placeholder' => 'Username')) }}

		{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}

		{{ Form::submit('Login', array('class' => 'form-control btn-success')) }}

	{{ Form::close() }}
@stop