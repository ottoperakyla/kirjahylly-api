@extends('layouts.master')

@section('content')
<h1>Book listing</h1>
<table class="table-striped">
	<tr>
		<th>Title			</th>
		<th>Author			</th>
		<th>Language		</th>
		<th>Year			</th>
		<th>Image			</th>
		<th>Borrowed by		</th>
		<th>Created at		</th>
		<th>Updated at		</th>
		<th class="text-center" colspan="2">Action</th>
	</tr>

	<!-- find active row if defined -->
	@foreach($books as $book)
	<tr>
		<td>{{ link_to_action('BooksController@edit', $book->title, $book->id) 			}}</td>
		<td>{{ $book->author->first 		}} {{ $book->author->last 					}}</td>
		<td>{{ $languages[$book->language_id-1]->language 								}}</td>
		<td>{{ $book->year 																}}</td>
		<td>{{ $book->image ? HTML::link($book->image, 'Image') : 'No image' 			}}</td>
		<td>{{ $book->borrower_id != null ? link_to_route('users.edit', User::getFullName($book->borrower_id), $book->borrower_id) : "" }}</td>
		<td>{{ $book->created_at 														}}</td>
		<td>{{ $book->updated_at 														}}</td>
		<td class="actions">
			{{ Form::open(array('action' => array('BooksController@destroy', $book->id), 'method' => 'delete', 'class' => 'deleteForm')) }}
			{{ Form::submit('Delete', array('class' => 'btn btn-danger btn-mini delete')) }}
			{{ Form::close() }}
		</td>
		<td class="actions">
			{{ Form::open(array('action' => array('BooksController@borrow', $book->id), 'method' => 'post', 'class' => 'borrowForm', 'data-status' => $book->status, 'data-bookId' => $book->id)) }}
			{{ Form::submit($borrowedText[$book->status][0], array('class' => "btn " . $borrowedText[$book->status][1] . " btn-mini")) }}
			{{ Form::close() }}
		</td>
	</tr>
	@endforeach
</table>
<div class="row">
	<div class="col-md-12">
		{{ $books->links() }}
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<a href="{{action('BooksController@create')}}"><button class="add btn btn-success btn-mini">Add Book</button></a>
	</div>
</div>

{{ HTML::script('assets/js/deleteConfirm.js') }}
{{ HTML::script('assets/js/borrowAs.js') }}
@stop