@extends('users/profile')
@section('post')
<div class="well col-md-8 col-md-offset-2">
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
<div class="well col-md-8 col-md-offset-2">
	<h3>Comments</h3>
		@if($post->postcomments)
			@foreach($post->postcomments as $postcomment)
			<div class="row comment">
				<div class="col-md-2 text-right">
					<a href="{{ action('UserController@show', [$postcomment->author_id])}}"> {{{ User::find($postcomment->author_id)->username }}}</a>
				</div>
				<div class="col-md-10">
					{{{ $postcomment->comment }}}
				</div>
			</div>
			@endforeach
		@else
			<p>This post has no Comments</p>
		@endif
		<div class="col-md-12">
		<hr />
		@if(Auth::check())
			{{ Form::open(['action' => ['PostController@postComment', $post->id], 'class' => 'form-horizontal']) }}
				<div class="form-group col-md-12">
					{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => "Hey, let's you and me get together some time ;)"]) }}	
				</div>
				<div class="form-group col-md-12">
					{{ Form::submit('Reply', ['class' => 'btn btn-primary']) }}
				</div>
			{{ Form::close() }}
		@else
			<a href="{{ route('login') }}">Login to leave a comment</a>
		@endif
		</div>
</div>
@stop