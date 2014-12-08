{{ Form::label('email', 'email') }}
{{ Form::text('email', Input::old('email', $user->email), array('class' => 'form-control', 'required' => 'required')) }}

{{ Form::label('first', 'first') }}
{{ Form::text('first', Input::old('first', $user->first), array('class' => 'form-control', 'required' => 'required')) }}

{{ Form::label('last', 'last') }}
{{ Form::text('last', Input::old('last', $user->last), array('class' => 'form-control', 'required' => 'required')) }}