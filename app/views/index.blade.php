@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="well">
			<h1>Welcome to CS:GO Team Finder</h1>
			<p>Our goal is to make it easier for casual and competitive players and teams to find each other. Whether it's a temporary replacement because a teammate is MIA or a permanent addition to your team, you'll find someone here.</p>
			<p>To read more about what we're about, how this got started, or how to offer your support check out the <a href="{{ url('/about/') }}">About page</a>.</p>
			<h3 class="alpha text-center">Alpha Notice</h3>
			<p>This site is <em><u>very early</u></em> in development and there will be bugs. Bear with us while we continue our work on fixing everything and adding new features. In the mean time we appreciate any and all concerns, feedback, feature requests, etc.</p>
		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<h2>Get started now!</h2>
			<p><a href="{{ action('UserController@create') }}">Create an account</a> or <a href="{{ route('login') }}">Login</a> to start finding teammates now!</p>
		</div>
		<div class="well">
			<h4>Help with development</h4>
			<p>Get involved and make your opinion matter through our GitHub repo <a href="https://github.com/messerli90/csgo.teamfinder">messerli90/csgo.teamfinder</a></p>
		</div>
		<div class="well">
			<p>Active Posts: {{ Post::all()->count() }}</p>
			<p>Registered Users: {{ User::all()->count() }}</p>
				
		</div>
	</div>
</div>


@stop