@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="well">
			<h1>Welcome to CS:GO Team Finder</h1>
			<p>Our goal is to make it easier for casual and competitive players and teams to find each other. Whether it's a temporary replacement because a teammate is MIA or a permanent addition to your team, you'll find someone here.</p>
			<p>To read more about what we're about, how this got started, or how to offer your support check out the <a href="{{ url('/about/') }}">About page</a>.</p>
			<h2>What's New</h2>
			<p>We've been hard at work in the last month since our initial launch and have been working off the feedback from reddit and the community. We're happy to to bring this new Version with lots of improvements like:</p>
			<ul>
				<li>Steam Login</li>
				<li>Steam Username and Avatar</li>
				<li>More condensed post list</li>
				<li>Shortlist - Add players to your shortlist to keep track of the ones you're interested in</li>
				<li>Status - Let people know if you're still looking or have found a team</li>
			</ul>
		</div>
		<div class="well">
			<h3 class="alpha text-center">Bravo Notice</h3>
			<p>This site is <em><u>early</u></em> in development and there will be bugs. Bear with us while we continue our work on fixing everything and adding new features. In the mean time we appreciate any and all concerns, feedback, feature requests, etc.</p>
		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<h2>Thank You!</h2>
			<p>
				I want to thank all the people who have been helping us grow, whether you put the word out to your friends or are actively helping in the development.
			</p>
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