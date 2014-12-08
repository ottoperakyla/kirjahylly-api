{{ Form::label('title', 'Title') }}
{{ Form::text('title', Input::old('title', $book->title), array('class' => 'form-control', 'required' => 'required')) }}

{{ Form::label('author', 'Author') }}
{{ Form::select('author_id', $authors, $book->author ? $book->author->id : "", array('class' => 'form-control', 'required' => 'required')) }}

{{ Form::label('language_id', 'Language') }}
{{ Form::select('language_id', $languages, $book->language ? $book->language->id : "", array('class' => 'form-control', 'required' => 'required')) }}

{{ Form::label('year', 'Year') }}
{{ Form::text('year', Input::old('year', $book->year), array('class' => 'form-control', 'required' => 'required')) }}

{{ Form::label('description', 'Description') }}
{{ Form::textarea('description', Input::old('description', $book->description), array('class' => 'form-control', 'required' => 'required'))}}

{{ Form::label('status', 'Status') }}
{{ Form::checkbox('status', $book->status, 'status', array('class' => 'form-control')) }}

{{ Form::label('image', 'Image') }}
{{ Form::text('image', Input::old('image', $book->image), array('class' => 'form-control', 'disabled' => 'disabled')) }}

{{ Form::label('image', $book->image ? 'Change image' : 'Upload image') }}
{{ Form::file('image', array('class' => 'form-control')) }}