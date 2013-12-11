@if(Session::has('errors'))
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
	</div>
@endif

{{ Form::open(['action' => 'UserController@store']) }}

	{{ Form::label('username', 'Username') }}
	{{ Form::text('username') }}

	{{ Form::label('email', 'Email') }}
	{{ Form::email('email') }}

	{{ Form::label('password', 'Password') }}
	{{ Form::password('password') }}

	{{ Form::label('password_confirmation', 'Confirm Password') }}
	{{ Form::password('password_confirmation') }}

	{{ Form::submit('Register') }}


{{ Form::close() }}