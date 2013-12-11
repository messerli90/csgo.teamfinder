<h1>Login</h1>
@if(Session::has('error'))
	<p>Email / Password combination invalid</p>
@endif

{{ Form::open(['action' => 'UserController@postLogin']) }}
	<p>
		{{ Form::label('email', 'Email') }}
		{{ Form::email('email') }}
	</p>
	<p>
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
	</p>
	<p>
		{{ Form::submit('Login') }}
	</p>
{{ Form::close() }}