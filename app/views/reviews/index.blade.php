@extends('layouts.master')

@section('content')
<h1>Review listing</h1>
<table class="table-striped">
	<tr>
		<th>Book		</th>
		<th>User		</th>
		<th>Body		</th>
		<th>Stars		</th>
		<th>Created at	</th>
		<th>Updated at	</th>
		<th class="text-center" colspan="2">Action</th>
	</tr>

	<!-- find active row if defined -->
	@foreach($reviews as $review)

	@if(Session::has('active'))
		@if(Session::get('active') === $review->id)
			<tr class="active">
		@else
			<tr>
		@endif
	@endif
		<td>{{ link_to_route('books.edit', $review->book_id, $review->book_id) }}</td>
		<td>{{ link_to_route('users.edit', $review->user_id, $review->user_id) }}</td>
		<td>{{ $review->body }}</td>
		<td>{{ $review->stars }}</td>
		<td>{{ $review->created_at 			}}</td>
		<td>{{ $review->updated_at 			}}</td>
		<td class="actions">
			{{ Form::open(array('action' => array('ReviewsController@destroy', $review->id), 'method' => 'delete', 'class' => 'deleteForm')) }}
			{{ Form::submit('Delete', array('class' => 'btn btn-danger btn-mini delete')) }}
			{{ Form::close() }}
		</td>
	</tr>
	@endforeach
</table>
<div class="row">
	<div class="col-md-12">
		{{ $reviews->links() }}
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<a href="{{action('ReviewsController@create')}}"><button class="add btn btn-success btn-mini">Add Review</button></a>
	</div>
</div>

{{ HTML::script('assets/js/deleteConfirm.js') }}
@stop