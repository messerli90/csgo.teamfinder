@extends('layouts.master')
@section('content')
<div class="row">

	<div class="jumbotron col-md-6 col-md-offset-3">
		<h1>{{ $post->user->username }}</h1>
			@if($post->user->bio)
				<p>{{{ $post->user->bio }}}</p>
			@endif

	</div>
	<div class="well col-md-6 col-md-offset-3">
		@if(Auth::check())
			@if(Auth::user()->id == $post->user->id)
				{{ Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'DELETE']) }}
					{{ Form::submit('Delete Post', ['class' => 'btn btn-danger btn-sm pull-right btn-post']) }}
				{{ Form::close() }}
				<a href="{{ action('PostController@edit', [$post->id]) }}" class="btn btn-sm btn-default pull-right btn-post">Edit Post</a>
			@else
				<a href="#" class="btn btn-sm btn-default pull-right btn-post"><span class="glyphicon glyphicon-flag"></span> Report Post</a>
			@endif
		@endif
		<h3>Goal:</h3>
		<p>{{{ $post->goal }}}</p>
		<h3>Contact:</h3>
		<p>{{{ $post->contact }}}</p>
		<div class="col-md-6">
			<h3>Looking for</h3>
			<ul>
			@foreach($post->lookingfors as $lookingfor)
				<li>{{$lookingfor->name}}</li>
			@endforeach
			</ul>

		</div>
		<div class="col-md-6">
			<h3>Playstyle</h3>
			<ul>
			@foreach($post->playstyles as $playstyle)
				<li>{{$playstyle->name}}</li>
			@endforeach
			</ul>

		</div>
	</div>

	<div class="well col-md-6 col-md-offset-3">

		<div class="col-md-6">
			<h3>Services:</h3>
			@if($post->user->steam || $post->user->esea || $post->user->leetway || $post->user->altpug)
			<table class="table table-condensed">
				@if($post->user->steam)
					<p>
						<a href="{{ $post->user->steam }}"><img src="{{ asset('/img/ext_services/steam_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
					</p>
				@endif
				@if($post->user->esea)
					<p>
						<a href="{{ $post->user->esea }}"><img src="{{ asset('/img/ext_services/esea_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
					</p>
				@endif
				@if($post->user->leetway)
					<p>
						<a href="{{ $post->user->leetway }}"><img src="{{ asset('/img/ext_services/leetway_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
					</p>
				@endif
				@if($post->user->altpug)
					<p>
						<a href="{{ $post->user->altpug }}"><img src="{{ asset('/img/ext_services/altpug_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
					</p>
				@endif
			</table>
			@else
				<p>This user doesn't use any third-party services.</p>
			@endif
		</div>

		<div class="col-md-6">
			<h3>Info:</h3>
			<table class="table table-condensed">
				<tr>
					<td>Rating</td>
					<td>
						@if($post->user->rating >= 0)
							<span class="good">{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-up"></span></span>
						@else
							<span class="bad">{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-down"></span></span>
						@endif
					</td>
				</tr>
				@if($post->user->birthday)
				<tr>
					<td>Age</td>
					<td>{{ date("Y-m-d")-date($post->user->birthday) }}</td>
				</tr>
				@endif
				@if($post->user->region)
				<tr>
					<td>Region</td>
					<td>{{ $post->user->region->name }}</td>
				</tr>
				@endif
				@if($post->user->skill)
				<tr>
					<td>Skill</td>
					<td>{{ $post->user->skill->name }}</td>
				</tr>
				@endif
				@if($post->user->rank)
				<tr>
					<td>Rank</td>
					<td>{{ $post->user->rank->name }}</td>
				</tr>
				@endif
				@if($post->user->voips)
				<tr>
					<td>Voip Services</td>
					<td>
					@foreach ($post->user->voips as $voip)
						<p>{{ $voip->name }}</p>
					@endforeach
					</td>
				</tr>
				@endif
			</table>
		</div>
	</div>

	@if($post->user->experience)
		<div class="col-md-6 well col-md-offset-3">
			<h3>Experience</h3>
			<p>{{{ $post->user->experience }}}</p>
		</div>
	@endif

	<div class="well col-md-6 col-md-offset-3">
		<div class="col-md-12">
			<h3>Reviews <a href="{{ action('UserController@getReview', [$post->user->id]) }}" class="btn btn-default pull-right">Leave a Review</a></h3>
			@if($post->user->ratings)
				<table class="table">
					<thead>
						<tr>
							<td>Author</td>
							<td>Review</td>
							<td>Rating</td>
						</tr>
					</thead>
					<tbody>
						@foreach ($post->user->ratings as $rating)
						<tr>
							<td>{{ User::find($rating->author_id)->username }}</td>
							<td>{{{ $rating->review }}}</td>
							<td>
								@if ($rating->score == 1)
								<span class="glyphicon glyphicon-thumbs-up good"></span>
								@else
								<span class="glyphicon glyphicon-thumbs-down bad"></span>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<p>This user hasn't been reviewed yet</p>
			@endif
		</div>
	</div>
</div>


@stop
