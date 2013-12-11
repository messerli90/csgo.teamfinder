<h1>{{ $user->username }}</h1>

<table>
	@if($user->username)
	<tr>
		<td>Username</td>
		<td>{{ $user->username }}</td>
	</tr>
	@endif
	@if($user->avatar)
	<tr>
		<td>Avatar</td>
		<td><img src="{{ asset($user->avatar) }}" width="100"></td>
	</tr>
	@endif
	@if($user->birthday)
	<tr>
		<td>Birthday</td>
		<td>{{ $user->birthday }}</td>
	</tr>
	@endif
	@if($user->steam)
	<tr>
		<td>Steam</td>
		<td>{{ $user->steam }}</td>
	</tr>
	@endif
	@if($user->esea)
	<tr>
		<td>ESEA</td>
		<td>{{ $user->esea }}</td>
	</tr>
	@endif
	@if($user->leetway)
	<tr>
		<td>Leetway</td>
		<td>{{ $user->leetway }}</td>
	</tr>
	@endif
	@if($user->altpug)
	<tr>
		<td>AltPug</td>
		<td>{{ $user->altpug }}</td>
	</tr>
	@endif
	@if($user->region)
	<tr>
		<td>Region</td>
		<td>{{ $user->region->name }}</td>
	</tr>
	@endif
	@if($user->skill)
	<tr>
		<td>Skill</td>
		<td>{{ $user->skill->name }}</td>
	</tr>
	@endif
	@if($user->rank)
	<tr>
		<td>Rank</td>
		<td>{{ $user->rank->name }}</td>
	</tr>
	@endif
	@if($user->bio)
	<tr>
		<td>Bio</td>
		<td>{{ $user->bio }}</td>
	</tr>
	@endif
</table>