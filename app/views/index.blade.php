@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-8">
			<h1>Looking for a CS:GO Team?</h1>
		<div class="well">
			<p>Our goal is to make it easier for casual and competitive players and teams to find each other. Whether it's a temporary replacement because a teammate is MIA or a permanent addition to your team, you'll find someone here.</p>
			<p>To read more about what we're about, how this got started, or how to offer your support check out the <a href="{{ url('/about/') }}">About page</a>.</p>
		</div>
		<div class="col-md-6">
			<h3>Newest Posts</h3>
			@foreach ($posts as $post)
				<div class="well quicklist clearfix">
					<img src="{{ $post->user->rank->img }}" alt="{{ $post->user->username }} avatar" class="pull-right rank" width="60px">
					<a href="{{ action('PostController@show', [$post->id]) }}"><small>{{ $post->user->username }}</small></a>
          @if ($post->region)
						<p class="small-caps region">{{ $post->user->region->name }}</p>
					@endif
				</div>
			@endforeach
		</div>
		<div class="col-md-6">
			<h3>Newest Team Posts</h3>
			@foreach ($teamposts as $teampost)
				<div class="well quicklist clearfix">
					@foreach ($teampost->playstyles as $playstyle)
					<img src="{{ $playstyle->img }}" alt="{{ $playstyle->name }} avatar" class="pull-right rank" width="20px">
					@endforeach
					<a href="{{ action('TeampostController@show', [$teampost->id]) }}"><small>{{ $teampost->name }}</small></a>
					<p class="small-caps region">{{ $teampost->region->name }}</p>
				</div>
			@endforeach
		</div>
	</div>
	<div class="col-md-4">
		<h3>What's New</h3>
		<div class="well">
			<p>I try to keep up with all your demands and ideas as much as I can, and I believe the last couple updates have really turned out great! This site is built on the ideas of the community; Some of the things that have been implemented because of you in the last couple weeks are:</p>
			<ul>
				<li>Team Posts - For Teams advertising themselves and getting started</li>
				<li>Filters for rank and region</li>
				<li>Steam Login</li>
				<li>Steam Username and Avatar</li>
				<li>More user-friendly post list</li>
				<li>Shortlist - Add players to your shortlist to keep track of the ones you're interested in</li>
				<li>Status - Let people know if you're still looking or have found a team</li>
			</ul>
		</div>
		<h4>Help with development</h4>
			<div class="well">
				<p>Get involved and make your opinion matter through our GitHub repo <a href="https://github.com/messerli90/csgo.teamfinder">messerli90/csgo.teamfinder</a></p>
			</div>
		<h4>Stats</h4>
		<div class="well">
			<p>Active Posts: {{ Post::all()->count() }}</p>
			<p>Registered Users: {{ User::all()->count() }}</p>
		</div>
	</div>
</div>


@stop