@extends('layouts.master')
@section('content')

<div class="well">
<h1>Users</h1>

@if ($users->isEmpty())
	<p>Sorry, no users at this time</p>
@else
<table class="table">
	<tr>
		<td>ID</td>
		<td>Username</td>
	</tr>
	@foreach($users as $user)
	<tr>
		<td>{{ $user->id }}</td>
		<td><a href="{{ action('UserController@show', [$user->id]) }}">{{ $user->username }}</a></td>
	</tr>
	@endforeach
</table>
@endif
</div>
@stop
