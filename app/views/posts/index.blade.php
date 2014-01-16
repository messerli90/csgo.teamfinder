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
		<div class="well filter">
			<h2>Filters</h2>
		</div>
	</div>
	<div class="col-md-9" id="container">
	@if ($posts->isEmpty())
		<div class="well"><p>Sorry, no posts at this time</p></div>
	@else

		@foreach($posts as $post)
		<div class="col-md-12" id="{{ $post->id.'id' }}">
			<div class="well post clearfix">
				<div class="col-md-2">
						<img src="{{ $post->user->avatar }}" class="img-rounded avatar">	
				</div>
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-9">
							<h2><a href="#" data-toggle="modal" data-target="#{{{ $post->id.'modal' }}}">{{ $post->user->username }}</a></h2>
							@if($post->user->region)
							<p class="region">{{{ $post->user->region->name }}}
							 - 
							@endif
							@if ( strtotime($post->created_at) < strtotime('yesterday') )
								{{{ date("m/d/y", strtotime($post->created_at)) }}}
							@else 
								{{{ "Today at " . date("g:i A", strtotime($post->created_at)) }}}
							@endif
							<!--{{{ date("m/d/y g:i A", strtotime($post->created_at)) }}}</p>-->
						</div>
						<div class="col-md-3 text-right rating">
							@if ($post->postcomments->count() != 0)
								<span>{{{ $post->postcomments->count() }}} <span class="glyphicon glyphicon-comment"></span></span>
							@endif
							@if ($post->user->rating != 0)
								@if($post->user->rating > 0)
									<span class="good">{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-up"></span></span>
								@elseif($post->user->rating == 0)
									<span>{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-up"></span></span>
								@else
									<span class="bad">{{ $post->user->rating }} <span class="glyphicon glyphicon-thumbs-down"></span></span>
								@endif
							@endif
						</div>
					</div><!-- ./top-row -->
					<!-- Button trigger modal -->
					<button class="btn btn-default btn-sm btn-post pull-right" data-toggle="modal" data-target="#{{{ $post->id.'modal' }}}">Open Card</button> 
			        @if(Auth::check())
				        @if(Auth::user()->id != $post->user->id)
							{{ Form::open(['action' => ['ShortlistController@update', $post->user->id], 'method' => 'put']) }}
							{{ Form::submit('Add to Shortlist', ['class' => 'btn btn-info btn-sm btn-post pull-right']) }}
							{{ Form::close() }}
						@endif
					@endif
				</div>
			</div>
		</div>


<!-- Modal -->
<div class="modal fade post" id="{{{ $post->id.'modal' }}}" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="row">
        	<div class="col-sm-2">
        		<img src="{{ $post->user->avatar }}" class="img-rounded avatar pull-left">		
        	</div>
        	<div class="col-sm-7">
		        <h4 class="modal-title" id="myModalLabel">{{{ $post->user->username }}}</h4>
		        @if($post->user->region)
					<p class="region">{{{ $post->user->region->name }}}
				@endif
        	</div>
        	<div class="col-sm-2 rank">
        		@if($post->user->rank)
        			<img src="{{ $post->user->rank->img }}" class="rank">
        		@endif
        	</div>
        </div>
        
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-md-6">
				
				<p class="text-center"><strong>Goal</strong></p>
					<p>{{{ $post->goal }}}</p>

			</div>
			<div class="col-md-6 text-center">
				<p><strong>Playstyle</strong></p>
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
			<div class="col-md-7">
				<p class="text-center"><strong>Contact</strong></p>
					<p>{{{ $post->contact }}}</p>
			</div>
			<div class="col-md-5 text-center">
				<div class="lookingfor">
					<p class=""><strong>Looking for</strong></p>
					<ul class="list-unstyled">
						@foreach($post->lookingfors as $lookingfor)
						<li>{{$lookingfor->name}}</li>
						@endforeach
					</ul>
				</div>

			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12 comments">
				<h3>Comments</h3>
					@if($post->postcomments->count() != 0)
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


      </div>
      <div class="modal-footer">
		@if(Auth::check())
			@if(Auth::user()->id == $post->user->id)
				{{ Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'DELETE']) }}
				{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-post pull-right']) }}
				{{ Form::close() }}
				<a type="button" href="{{ action('PostController@edit', [$post->id]) }}" class="btn btn-sm btn-default btn-post pull-right">Edit</a>
			@endif
		@endif

        <a type="button" class="btn btn-sm btn-primary btn-post pull-right" href="{{ action('UserController@show', [$post->user->id]) }}">User's Profile</a>
        @if(Auth::check())
	        @if(Auth::user()->id != $post->user->id)
				{{ Form::open(['action' => ['ShortlistController@update', $post->user->id], 'method' => 'put']) }}
				{{ Form::submit('Add to Shortlist', ['class' => 'btn btn-info btn-sm btn-post pull-right']) }}
				{{ Form::close() }}
			@endif
		@endif
		
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



		@endforeach
	</div>
	<div class="col-md-12 clearfix">
		{{ $posts->links() }}			
	</div>
	@endif
</div> <!-- ./row -->

@stop

