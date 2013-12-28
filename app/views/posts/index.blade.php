@extends('layouts.master')
@section('content')
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="/csgo/teamfinder/public/js/isotype.min.js" type="text/javascript"></script>
<div class="row">
	<div class="col-md-3">
		<div class="well">
			<a href="{{ action('PostController@create') }}" class="btn btn-primary">Add new Post</a>
		</div>
		<div class="well">
			<h2>Filters</h2>
			<ul id="filters">
			  <li><a href="#" data-filter="*">show all</a></li>
			  <li><a href="#" data-filter=".awp">AWP</a></li>
			  <li><a href="#" data-filter=".entryfragger">Entry Fragger</a></li>
			  <li><a href="#" data-filter=".support">Support</a></li>
			  <li><a href="#" data-filter=".flankerlurker">Flanker/ Lurker</a></li>
			  <li><a href="#" data-filter=".callerigl">Caller / IGL</a></li>
			  <li><a href="#" data-filter=".rifler">Rifler</a></li>
			</ul>
		</div>
	</div>
	<div class="col-md-9" id="container">
	@if ($posts->isEmpty())
		<div class="well"><p>Sorry, no posts at this time</p></div>
	@else

		@foreach($posts as $post)
		<div class="col-md-12 @foreach($post->playstyles as $playstyle){{ strtolower(str_replace("/","",str_replace(" ","",$playstyle->name))) }} @endforeach">

			<div class="well post clearfix">
				<div class="col-md-2">
				<div class="row">
					<div class="col-sm-12">
						@if($post->user->rank)
						<img src="{{ $post->user->rank->img }}" class="rank ">	
						@endif
					</div>
					<div class="col-sm-12">
						<p class="lookingfor"><strong>Looking for</strong></p>
						<ul class="list-unstyled">
							@foreach($post->lookingfors as $lookingfor)
							<li>{{$lookingfor->name}}</li>
							@endforeach
						</ul>
					</div>
				</div>
				</div>
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-9">
							<h2><a href="{{ action('PostController@show', [$post->id]) }}">{{ $post->user->username }}</a></h2>
							@if($post->user->region)
							<p class="region">{{{ $post->user->region->name }}}
							@endif
							 - {{{ date("m/d/y g:i A", strtotime($post->created_at)) }}}</p>
						</div>
						<div class="col-md-3 text-right rating">
							<span>{{{ $post->postcomments->count() }}} <span class="glyphicon glyphicon-comment"></span></span>
							@if($post->user->rating > 0)
								<span class="good">{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-up"></span></span>
							@elseif($post->user->rating == 0)
								<span>{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-up"></span></span>
							@else
								<span class="bad">{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-down"></span></span>
							@endif
						</div>
					</div><!-- ./top-row -->
					<div class="row">
						<div class="col-md-7">
							
							<p><strong>Goal</strong></p>
							@if(strlen($post->goal) > 120)
								<p>{{{ substr($post->goal, 0, 120) }}} ...</p>
							@else
								<p>{{{ $post->goal }}}</p>
							@endif

						</div>
						<div class="col-md-5 text-center">
							<p><strong>Playstyle</strong></p>
							<!--
							<ul class="list-unstyled">
								@foreach($post->playstyles as $playstyle)
									<li><img src="{{ asset($playstyle->img) }}" class="role-icons"> {{ $playstyle->name }}</li>
								@endforeach
							</ul>
							-->
							@foreach($post->playstyles as $playstyle)
								<div class="roles">
								<img src="{{ asset($playstyle->img) }}"  class="role-icons" alt="...">
									<div class="caption">
										<small>{{ $playstyle->name }}</small>
									</div>
								</div>
							@endforeach

						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<a href="{{ action('PostController@show', [$post->id]) }}" class="btn btn-primary btn-sm">Read More...</a>
						</div>
						<div class="col-md-3 col-md-offset-9">
							@if(Auth::check())
								@if(Auth::user()->id == $post->user->id)
									{{ Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'DELETE']) }}
										{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm pull-left btn-post']) }}
									{{ Form::close() }}
									<a href="{{ action('PostController@edit', [$post->id]) }}" class="btn btn-sm btn-default pull-left btn-post">Edit</a>
								@else
									<a href="#" class="btn btn-sm btn-default pull-left btn-post"><span class="glyphicon glyphicon-flag"></span> Report</a>
								@endif
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<div class="col-md-12 clearfix">
		{{ $posts->links() }}			
	</div>
	@endif
</div> <!-- ./row -->

	<script type="text/javascript">
		var $container = $('#container');
		$(window).load(function(){
			// cache container
			// initialize isotope
			$container.isotope({
			  // options...
			});
			// filter items when filter link is clicked
			$('#filters a').click(function(){
			  var selector = $(this).attr('data-filter');
			  $container.isotope({ filter: selector });
			  return false;
			});
		});
	</script>
@stop

