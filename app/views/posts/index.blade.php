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
		<h4>Filter</h4>
		<div class="well">
			{{ Form::open(['action' => 'PostController@postFilter', 'class' => 'form-horizontal']) }}
				<div class="form-group">
				{{ Form::label('minrank', 'Minimum Rank', ['class' => 'col-sm-4 small']) }}
					<div class="col-sm-8">
						@if (isset($minrank))
							{{ Form::select('minrank', ['Any', 'Ranks' => $rank_options], $minrank, ['class' => 'form-control input-sm']) }}
						@else
						{{ Form::select('minrank', ['Any', 'Ranks' => $rank_options], null, ['class' => 'form-control input-sm']) }}
						@endif
					</div>
				</div>
				<div class="form-group">
				{{ Form::label('maxrank', 'Maximum Rank', ['class' => 'col-sm-4 small']) }}
					<div class="col-sm-8">
					@if (isset($maxrank))
						{{ Form::select('maxrank', ['Any', 'Ranks' => $rank_options], $maxrank, ['class' => 'form-control input-sm']) }}
					@else
						{{ Form::select('maxrank', ['Any', 'Ranks' => $rank_options], null, ['class' => 'form-control input-sm']) }}
					@endif
					</div>
				</div>
				<div class="form-group">
				{{ Form::label('region', 'Region', ['class' => 'col-sm-4 small']) }}
					<div class="col-sm-8">
					@if (isset($region))
						{{ Form::select('region', ['Any', 'Regions' => $region_options], $region, ['class' => 'form-control input-sm']) }}
					@else 
						{{ Form::select('region', ['Any', 'Regions' => $region_options], null, ['class' => 'form-control input-sm']) }}
					@endif
					</div>
				</div>
				{{ Form::submit('Apply', ['class' => 'btn btn-primary'])}}
			{{ Form::close() }}
		</div>
		<div class="well">
			<img src="{{ asset('img/ads/mumble.png') }}" alt="mumble logo" class="col-md-4 pull-left" />
			<h4>Free Mumble Server!</h4>
				<small>Found someone to play with but don't want to use in game voice? Check out this free to use Mumble server with your new party!</small>
				<br><br><small><strong>IP: </strong>csgoreddit.mumble.com</small>
				<br><small><strong>Port: </strong>5422</small>
		</div>
	</div>
	<div class="col-md-7" id="container">
	@if (count($posts) == 0)
		<div class="well"><p>Sorry, no posts at this time</p></div>
	@else
	@foreach($posts as $post)
	<div class="col-md-12">
		<div class="post well clearfix">
			<div class="row top">
				<div class="col-md-2">
					<a href="{{ action('PostController@show', [$post->id]) }}#post">
						<img src="{{ $post->avatar }}" alt="{{ $post->username . "Avatar" }}" class="img-rounded" width="80" />
					</a>
				</div>
				<div class="col-md-7">
					<a href="{{ action('PostController@show', [$post->id]) }}#post"><h2>{{{ $post->username }}}</h2></a>
					@if ($post->region)
					<small class="region">{{{ $post->region }}}</small>
					@endif
				</div>
				<div class="col-md-3 text-right">
				@if ($post->rankID < 19)
					<img src="{{ $post->rankImage }}" alt="{{ $post->rank }}" width="100" data-toggle="tooltip" data-placement="bottom" title="{{{ $post->rank }}}" />
				@else 
					<p class="small-caps text-center">No Rank</p>
				@endif
				</div>
			</div><!-- ./top row -->
			<div class="bottom text-right">
				@if (count($post->postcomments) != 0)
					<a href="{{ action('PostController@show', [$post->id]) }}#comments" class="comments"><small>{{{ count($post->postcomments) }}} <span class="glyphicon glyphicon-comment"></span></small></a>
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

