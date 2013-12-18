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

	<div class="col-md-9">
	@if ($posts->isEmpty())
		<div class="well"><p>Sorry, no posts at this time</p></div>
	@else

		@foreach($posts as $post)
		<div class="col-md-12">
			<div class="well post clearfix">
				<div class="col-md-2">
				<div class="row">
					<div class="col-sm-12">
						<img src="{{ $post->user->rank->img }}" class="rank ">	
					</div>
					<div class="col-sm-12">
						<h3>Looking for</h3>
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
							<h2><a href="{{ action('UserController@show', [$post->user->id]) }}">{{ $post->user->username }}</a></h2>
							<p class="region">{{{ $post->user->region->name }}} - {{{ date("m/d/y g:i A", strtotime($post->created_at)) }}}</p>
						</div>
						<div class="col-md-3 text-right rating">
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
							<ul class="list-unstyled">
								@foreach($post->playstyles as $playstyle)
									<li>{{ $playstyle->name }}</li>
								@endforeach
							</ul>

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
		<!--
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
		-->
		@endforeach
	</div>
	<div class="col-md-12 clearfix">
		{{ $posts->links() }}			
	</div>
	@endif
</div> <!-- ./row -->

@stop
