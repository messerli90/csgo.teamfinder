<h1>Create new Post</h1>

@if(Session::has('errors'))
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
	</div>
@endif

{{ Form::open(['action' => 'PostController@store']) }}
	
	{{ Form::label('goal', 'Goal') }}
	{{ Form::textarea('goal') }}

	{{ Form::label('contact', 'Contact') }}
	{{ Form::textarea('contact') }}

	{{ Form::label('lookingfor[]', 'What are you looking for?') }}

	@foreach($lookingfors as $lookingfor)
	<p>
		{{ Form::checkbox('lookingfors[]', $lookingfor->id) }}
		{{ Form::label('lookingfors[]', $lookingfor->name) }}
	</p>
	@endforeach

	{{ Form::label('playstyles[]', 'Playstyle') }}
	@foreach($playstyles as $playstyle)
	<p>
		{{ Form::checkbox('playstyles[]', $playstyle->id) }}
		{{ Form::label('playstyles[]', $playstyle->name) }}
	</p>
	@endforeach

	{{ Form::submit('Post') }}
{{ Form::close() }}