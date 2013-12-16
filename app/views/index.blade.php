@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="well">
			<h1>Welcome to CS:GO Team Finder</h1>
			<p>Our goal is to make it easier for casual and competitive players and teams to find each other. Whether it's a temporary replacement because a teammate is MIA or a permanent addition to your team, we'll have you covered.</p>
		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<h2>Get started now!</h2>
			<p><a href="#">Create an account</a> or <a href="#">Login</a> to start finding teammates now!</p>
			<a href="{{ action('UserController@index') }}" class="btn btn-default">Users</a>
			<a href="{{ action('PostController@index') }}" class="btn btn-default">Posts</a>
		</div>
	</div>
</div>


@stop