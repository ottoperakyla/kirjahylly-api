@extends('layouts.master')

@if($errors->has())
	@include('partials/error-list')
@endif

@section('content')
  <h1>Add new book</h1>

  {{ Form::open(array('action' => 'BooksController@store', 'files' => 'true')) }}

  @include('partials/book-form-fields')

  {{ Form::submit('Add book', ['class' => 'btn btn-success btn-large form-control']) }}
  
  {{ link_to(URL::previous(), 'Cancel', array('class' => 'btn btn-large bnt-default form-control'))}}
  {{ Form::close() }}
@stop