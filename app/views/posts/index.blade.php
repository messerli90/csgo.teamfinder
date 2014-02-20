@extends('layouts.master')
@section('content')
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="/csgo/teamfinder/public/js/isotype.min.js" type="text/javascript"></script>
	@if (Session::has('message'))
		<div class="col-md-12">
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ Session::get('message') }}
			</div>
		</div>
	@endif

<div class="row">
	<div class="col-md-3">
		<div class="well">
			<a href="{{ action('PostController@create') }}" class="btn btn-primary">Add new Post</a>
		</div>
		<div class="well">
			<img src="{{ asset('img/ads/mumble.png') }}" alt="mumble logo" class="col-md-4 pull-left" />
			<h4>Free Mumble Server!</h4>
				<small>Found someone to play with but don't want to use in game voice? Check out this free to use Mumble server with your new party!</small>
				<br><br><small><strong>IP: </strong>csgoreddit.mumble.com</small>
				<br><small><strong>Port: </strong>5422</small>
		</div>

		<!-- 
		<div class="well filter">
			<h2>Filters</h2>
		</div>
		-->
	</div>
	<div class="col-md-7" id="container">
	@if ($posts->isEmpty())
		<div class="well"><p>Sorry, no posts at this time</p></div>
	@else
	@foreach($posts as $post)
	<div class="col-md-12">
		<div class="post well clearfix">
			<div class="row top">
				<div class="col-md-2">
					<a href="{{ action('PostController@show', [$post->id]) }}#post">
						<img src="{{ $post->user->avatar }}" alt="{{ $post->user->username . "Avatar" }}" class="img-rounded" width="80" />
					</a>
				</div>
				<div class="col-md-7">
					<a href="{{ action('PostController@show', [$post->id]) }}#post"><h2>{{{ $post->user->username }}}</h2></a>
					@if ($post->user->region)
					<small class="region">{{{ $post->user->region->name }}}</small>
					@endif
				</div>
				<div class="col-md-3 text-right">
				@if ($post->user->rank->id < 19)
					<img src="{{ $post->user->rank->img }}" alt="{{ $post->user->rank->name }}" width="100" />
				@else 
					<p class="small-caps text-center">No Rank</p>
				@endif
				</div>
			</div><!-- ./top row -->
			<div class="bottom text-right">
				@if ($post->postcomments->count() != 0)
					<a href="{{ action('PostController@show', [$post->id]) }}#comments" class="comments"><small>{{{ $post->postcomments->count() }}} <span class="glyphicon glyphicon-comment"></span></small></a>
				@endif
			</div>
		</div>
	</div>






	@endforeach
	</div>
	<div class="col-md-1 col-md-offset-1">
		<div class="well  pull-right">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Sidebar -->
			<ins class="adsbygoogle"
	     style="display:inline-block;width:120px;height:600px"
	     data-ad-client="ca-pub-0223519100876576"
	     data-ad-slot="3658565739"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
			
		</div>
	</div>
	<div class="col-md-6 col-md-offset-4 clearfix">
		{{ $posts->links() }}			
	</div>
	@endif
</div> <!-- ./row -->

@stop

