<div class="bg-danger">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="errors">
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
