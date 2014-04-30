@extends('layouts.master')
@section('content')

<div class="row">
	<div class="col-md-8">
		<div class="well">
			<h2>About</h2>
			<p>Hi, I'm kniFely.</p>
			<p>Ever since my fingers could reach WASD I've been an avid gamer. Counter-Strike is one of the games I grew up on and I love that it is getting the attention it deserves again.  Besides gaming, I am passionate about making things that simplify life, learning, and helping people. This site is the compilation of all of these passions, and really started as a learning experience for me. When development (and my knowledge) progressed I realized this could actually be used, and be of benefit to the community. </p>
			<p>I mentioned, as a side-note, I was working on something to help players find each other on Reddit and the feedback was great, pushing me to get at least an Alpha build out as soon as possible.</p>
			<p>There will be problems, bugs, and inconsistencies while we sort out these all out. Please bear with us or lend your support. I would appreciate all feedback and concerns at <a href="mailto:knifelych@gmail.com">knifelych@gmail.com</a>.</p>
			<p>Happy Fragging</p>
			<blockquote>
				<small>Mike 'kniFely' Messerli</small>
			</blockquote>

			<h2>CS:GO Team Finder</h2>
			<p>I created this site to make it as easy as possible to find good teammates, some of the considerations to make this possible are:</p>
			<ul>
				<li><strong>A rating/review system</strong> to leave feedback on players you know, or have played with in the past</li>
				<li>Full-rounded <strong>profile page</strong> with links to Third-party Pug Services</li>
				<li><strong>Goals</strong> to let people know exactly what you're trying to get out of a team, whether it's joining a league or casual MM fun</li>
				<li>Find players by <strong>Playstyle</strong> to get exactly what you need in your team</li>
				<li><strong>Have fun</strong> playing with like-minded people, CS:GO is a great game!</li>
			</ul>
		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			<h4>Things we're working on:</h4>
			<ul>
				<li>Filter Optimization &amp; AJAX</li>
				<li>Coaches &amp; Trainers page</li>
			</ul>
			<!--<a href="{{ url('about/changelog') }}">Changelog</a>-->
		</div>
		<div class="well">
			<h4>Contact</h4>
			<p>I look forward to handling any and all concerns you may have, here's how to get in touch with me:</p>
			<p><a href="http://steamcommunity.com/groups/csgoteamfinder">CSGOTF Steamgroup</a></p>
			<p><a href="http://steamcommunity.com/id/knifely">My personal Steam</a></p>
			<p><a href="mailto:knifelych@gmail.com">Email</a></p>
			<p><a href="https://twitter.com/kniFelyCH">Twitter</a></p>
		</div>
		<div class="well">
			<h4>Help with development!</h4>
			<p>Get involved and make your opinion matter through our GitHub repo <a href="https://github.com/messerli90/csgo.teamfinder">messerli90/csgo.teamfinder</a></p>
		</div>
	</div>

	
</div>

@stop