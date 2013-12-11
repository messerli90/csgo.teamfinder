<h1>Users</h1>

@if ($users->isEmpty())
	<p>Sorry, no users at this time</p>
@else
<table>
	<tr>
		<td>ID</td>
		<td>Username</td>
		<td>Email</td>
		<td>Action</td>
	</tr>
	@foreach($users as $user)
	<tr>
		<td>{{ $user->id }}</td>
		<td><a href="{{ action('UserController@show', [$user->id]) }}">{{ $user->username }}</a></td>
		<td>{{ $user->email }}</td>
		<td><a href="{{ action('UserController@edit', [$user->id]) }}">Edit</a></td>
	</tr>
	@endforeach
</table>
@endif