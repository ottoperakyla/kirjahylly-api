@extends('layouts.master')

@section('content')
	<h1>Edit book</h1>
	{{ Form::model($book, array('url' => "books/$book->id", 'method' => 'PATCH'))}}

 	 @include('partials/book-form-fields')

	 {{ Form::submit('Save changes', ['class' => 'btn btn-success btn-large form-control']) }}
	 {{ link_to(URL::previous(), 'Cancel', array('class' => 'btn btn-large bnt-default form-control'))}}
	 
  {{ Form::close() }}
@stop