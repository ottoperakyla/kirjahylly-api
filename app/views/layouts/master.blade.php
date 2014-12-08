<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="initial-scale=1">
	<title>Kirjahylly backend</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/app.css') }}">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@if(Auth::check())
				<a id="logout" href="{{ URL::to('logout') }}">{{ Form::button('logout', array('class' => 'btn btn-primary')) }}</a>
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation">
						{{ link_to('books', 'Books') }}
					</li>
					<li role="presentation">
						{{ link_to('reviews', 'Reviews') }}
					</li>
					<li role="presentation">
						{{ link_to('users', 'Users') }}
					</li>
				</ul>
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				@yield('content')
			</div>
		</div>
	</div>
	{{ HTML::script('assets/js/jquery.min.js') }}
	{{ HTML::script('assets/js/activeItem.js') }}
</body>
</html>