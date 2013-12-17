@extends('layouts.master')
@section('content')

<div class="row">
	<div class="col-md-3">
		<div class="well">
			<a href="{{ action('PostController@create') }}" class="btn btn-primary">Add new Post</a>
		</div>
		<div class="well">
			<h2>Filters</h2>
			<p>Coming soon...</p>
		</div>
	</div>

	<div class="col-md-7">
	@if ($posts->isEmpty())
		<div class="well"><p>Sorry, no posts at this time</p></div>
	@else

		@foreach($posts as $post)
		<div class="col-md-12">
			<div class="well post clearfix">
				<h2><a href="{{ action('UserController@show', [$post->user->id]) }}">{{ $post->user->username }}</a></h2>
				<div class="well well-sm">
					<img src="{{ $post->user->rank->img }}" class="rank">
					<p class="pull-right">
						@if($post->user->rating > 0)
							<span class="good">{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-up"></span></span>
						@elseif($post->user->rating == 0)
							<span>{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-up"></span></span>
						@else
							<span class="bad">{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-down"></span></span>
						@endif
					</p>
				</div>
				<div class=" col-md-6">
					<h4>Region</h4>
						<p>{{ $post->user->region->name }}</p>
					<h4>Looking for</h4>
						<ul>
							@foreach($post->lookingfors as $lookingfor)
							<li>{{$lookingfor->name}}</li>
							@endforeach
						</ul>
					<h4>Playstyle</h4>
						<ul>
							@foreach($post->playstyles as $playstyle)
							<li>{{ $playstyle->name }}</li>
							@endforeach
						</ul>

				</div>
				<div class="col-md-6">
					<h4>Goal</h4>
						@if(strlen($post->goal) > 120)
							<p>{{{ substr($post->goal, 0, 120) }}} ...</p>
						@else
							{{{ $post->goal }}}
						@endif
					<h4>Contact me</h4>
						@if(strlen($post->contact) > 120)
							<p>{{{ substr($post->contact, 0, 120) }}} ...</p>
						@else
							{{{ $post->contact }}}
						@endif
					
				</div>
				<div class="col-md-12 clearfix">
					<a href="{{ action('PostController@show', [$post->id]) }}" class="btn btn-primary pull-right">Read More...</a>
					<a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-flag"></span> Report</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<div class="col-md-2">
		<div class="well">
			<h4>Sponsors</h4>
		</div>
	</div>
	<div class="col-md-12 clearfix">
		{{ $posts->links() }}			
	</div>
	@endif
</div> <!-- ./row -->

@stop
