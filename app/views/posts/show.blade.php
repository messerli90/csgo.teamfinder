@extends('users/profile')
@section('post')
<div class="col-md-12" id="post">
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
	<div class="col-md-3 col-xs-12">
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
			<p>
				{{ $parsedown->text($post->goal) }}
			</p>
		</div>
		<h4>Contact:</h4>
		<div class="well">
			<p>{{ $parsedown->text($post->contact) }}</p>
		</div>
	</div>
	<div class="col-md-6">

	</div>
	<div class="col-md-6">

	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12" id="comments">
      <div class="col-md-12 col-xs-12">
        <h3 id="comments">Comments</h3>

        @if(count($post->postcomments) > 0)
          @foreach($post->postcomments as $postcomment)
            @if($postcomment->author_id == $post->user->id)
              <div class="row clearfix">
                <div class="col-md-10 col-xs-8">
                  <div class="well">
                    <p>{{ $parsedown->text($postcomment->comment) }}</p>
                  </div>
                </div>
                <div class="col-md-2 col-xs-3">
                  <a href="{{ action('UserController@show', [$postcomment->author_id]) }}" >
                    <img src="{{ User::find($postcomment->author_id)->avatar }}" alt="{{ User::find($postcomment->author_id)->username }}" class="col-md-8 col-xs-12 col-md-offset-2 col-xs-offset-0">
                  </a>
                  <p class="text-center small-caps"><a href="{{ action('UserController@show', [$postcomment->author_id]) }}" > {{{ User::find($postcomment->author_id)->username }}}</a></p>
                </div>
              </div>
            @else
            <div class="row clearfix">
              <div class="col-md-2 col-xs-3">
                <a href="{{ action('UserController@show', [$postcomment->author_id]) }}" >
                  <img src="{{ User::find($postcomment->author_id)->avatar }}" alt="{{ User::find($postcomment->author_id)->username }}" class="col-md-8 col-xs-12 col-md-offset-2 col-xs-offset-0">
                </a>
                <p class="text-center small-caps"><a href="{{ action('UserController@show', [$postcomment->author_id]) }}" > {{{ User::find($postcomment->author_id)->username }}}</a></p>
              </div>
              <div class="col-md-10 col-xs-8">
                <div class="well">
                  <p>{{ $parsedown->text($postcomment->comment) }}</p>
                </div>
              </div>
            </div>

            @endif
          @endforeach
        @else 
          <p>No comments</p>
        @endif
      </div>
      <div class="col-md-12">
        <hr />
        @if(Auth::check())
          {{ Form::open(['action' => ['PostController@postComment', $post->id], 'class' => 'form-horizontal']) }}
            <div class="form-group col-md-12">
              {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => "Hey, let's you and me get together some time ;)"]) }} 
              <small><a href="#" onclick="return markdownHelp()">Formatting Help</a></small>
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

<div class="col-md-8 col-md-offset-3">
	<div class="well">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- ProfileAd -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:728px;height:90px"
		     data-ad-client="ca-pub-0223519100876576"
		     data-ad-slot="9081036934"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
</div>

@stop