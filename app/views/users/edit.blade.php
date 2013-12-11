<h1>Edit {{ $user->username }}</h1>

{{ Form::model($user, ['route' => ['users.update', $user->id]]) }}

	{{ Form::label('username', 'Username')}}
	{{ Form::text('username') }}

	{{ Form::label('email', 'Email') }}
	{{ Form::email('email') }}

	{{ Form::label('steam', 'steam') }}
	{{ Form::text('steam') }}

	{{ Form::label('esea', 'esea') }}
	{{ Form::text('esea') }}

	{{ Form::label('leetway', 'leetway') }}
	{{ Form::text('leetway') }}

	{{ Form::label('altpug', 'altpug') }}
	{{ Form::text('altpug') }}

	{{ Form::label('region', 'Region') }}

	{{ Form::submit('Edit') }}

{{ Form::close() }}