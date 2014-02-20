@extends('users/profile')
@section('post')
<div class="row" id="post">
<h2 class="text-center">Post</h2>
	<div class="pullright">
		@if(Auth::check())
			@if(Auth::user()->id == $post->user->id)
				{{ Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'DELETE']) }}
					{{ Form::submit('Delete Post', ['class' => 'btn btn-danger btn-sm pull-right btn-post']) }}
				{{ Form::close() }}
				<a href="{{ action('PostController@edit', [$post->id]) }}" class="btn btn-sm btn-default btn-post pull-right">Edit Post</a>
			@else
				<a href="#" class="btn btn-sm btn-default pull-right btn-post"><span class="glyphicon glyphicon-flag"></span> Report Post</a>
			@endif
		@endif
	</div>
	<div class="col-md-3">
		<h4>Looking for</h4>
		<div class="well">
			<ul>
			@foreach($post->lookingfors as $lookingfor)
				<li>{{$lookingfor->name}}</li>
			@endforeach
			</ul>
		</div>
		<h4>Playstyle</h4>
		<div class="well">
			<ul>
			@foreach($post->playstyles as $playstyle)
				<li>{{$playstyle->name}}</li>
			@endforeach
			</ul>
		</div>
	</div>
	<div class="col-md-9">

		<h4>Goal:</h4>
		<div class="well">
			<p>{{{ $post->goal }}}</p>
		</div>
		<h4>Contact:</h4>
		<div class="well">
			<p>{{{ $post->contact }}}</p>
		</div>
	</div>
	<div class="col-md-6">

	</div>
	<div class="col-md-6">

	</div>
</div>
<div class="col-md-9 col-md-offset-3" id="comments">
	<h3>Comments</h3>
	<div class="well">
			@if($post->postcomments)
			<table class="table">
					@foreach($post->postcomments as $postcomment)
					<tr>
						<td>
							<a href="{{ action('UserController@show', [$postcomment->author_id])}}"> {{{ User::find($postcomment->author_id)->username }}}</a>
						</td>
						<td>
							{{{ $postcomment->comment }}}
						</td>
					</tr>
					@endforeach
			</table>
				
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
</div>

@stop