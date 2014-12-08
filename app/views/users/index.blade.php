@extends('layouts.master')

@section('content')
<h1>User listing</h1>
<table class="table-striped">
	<tr>
		<th>Email		</th>
		<th>First		</th>
		<th>Last		</th>
		<th>Created at	</th>
		<th>Updated at	</th>
		<th colspan="2">Action		</th>
	</tr>
	@foreach($users as $user)
	<tr>
		<td>{{ link_to_action('UsersController@edit', $user->email, $user->id) }}</td>
		<td>{{ $user->first 				}}</td>
		<td>{{ $user->last 					}}</td>
		<td>{{ $user->created_at			}}</td>
		<td>{{ $user->updated_at 			}}</td>
		@if(!$user->admin)
		<td>
			{{ Form::open(array('action' => array('UsersController@destroy', $user->id), 'method' => 'delete', 'class' => 'deleteForm')) }}
			{{ Form::submit('Delete', array('class' => 'btn btn-danger btn-mini delete')) }}
			{{ Form::close() }}
		</td>
		@else 
		<td colspan="2">&nbsp;</td>
		@endif
	</tr>
	@endforeach
</table>
<div class="row">
	<div class="col-md-12">
		{{ $users->links() }}
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<a href="{{action('UsersController@create')}}"><button class="add btn btn-success btn-mini">Add User</button></a>
	</div>
</div>


{{ HTML::script('assets/js/deleteConfirm.js') }}
@stop