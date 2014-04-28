@extends('layouts.master')
@section('content')
<div class="row" id="post">
  @if (Session::has('message'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('message') }}
      </div>
    </div>
  @endif
  <div class="pullright">
    @if(Auth::check())
      @if(Auth::user()->id == $post->user->id)
        {{ Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'DELETE']) }}
          {{ Form::submit('Delete Team', ['class' => 'btn btn-danger btn-sm pull-right btn-post']) }}
        {{ Form::close() }}
        <a href="{{ action('PostController@edit', [$post->id]) }}" class="btn btn-sm btn-default btn-post pull-right">Edit Team</a>
      @else
        <!--
        <a href="#" class="btn btn-sm btn-default pull-right btn-post"><span class="glyphicon glyphicon-flag"></span> Report Post</a>
        -->
      @endif
    @endif
  </div>

  <div class="col-md-8">
    <div class="well clearfix">
      @if ($post->avatar)
        <img src="{{ $post->avatar }}" alt="{{ $post->name }} logo" class="img-rounded col-md-3">
      @else 
        <img src="{{ asset('/img/teamposts/default.png') }}" alt="{{ $post->name }} logo" class="img-rounded col-md-3">
      @endif
      <h1>{{ $post->name }}</h1>  
      <small class="region">{{ $post->region->name }}</small>
    </div>

    <h4>Info</h4>
    <div class="well">
      <p>{{ $parsedown->text($post->info) }}</p>
    </div>

    <h3 id="comments">Comments</h3>

    @if(count($post->teampostcomments) > 0)
      @foreach($post->teampostcomments as $postcomment)
        @if($postcomment->author_id == $post->user->id)
          <div class="row">
            <div class="col-md-10">
              <div class="well">
                <p class="text-right">{{ $parsedown->text($postcomment->comment) }}</p>
              </div>
            </div>
            <div class="col-md-2">
              <a href="{{ action('UserController@show', [$postcomment->author_id]) }}" >
                <img src="{{ User::find($postcomment->author_id)->avatar }}" alt="User::find($postcomment->author_id)->username" class="col-md-8 col-md-offset-2">
              </a>
              <p class="text-center small-caps"><a href="{{ action('UserController@show', [$postcomment->author_id]) }}" > {{{ User::find($postcomment->author_id)->username }}}</a></p>
            </div>
          </div>
        @else
        <div class="row">
          <div class="col-md-2 ">
            <a href="{{ action('UserController@show', [$postcomment->author_id]) }}" >
              <img src="{{ User::find($postcomment->author_id)->avatar }}" alt="User::find($postcomment->author_id)->username" class="col-md-8 col-md-offset-2">
            </a>
            <p class="text-center small-caps"><a href="{{ action('UserController@show', [$postcomment->author_id]) }}" > {{{ User::find($postcomment->author_id)->username }}}</a></p>
          </div>
          <div class="col-md-10">
            <div class="well">
              {{ $parsedown->text($postcomment->comment) }}
            </div>
          </div>
        </div>

        @endif
      @endforeach
    @else 
      <p>No comments</p>
    @endif


  <div class="col-md-12">
    <hr />
    @if(Auth::check())
      {{ Form::open(['action' => ['TeampostController@postComment', $post->id], 'class' => 'form-horizontal']) }}
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
  <div class="col-md-4">
    <h4>Contact Person</h4>
    <div class="well">
      <p><a href="{{ action('UserController@show', [$post->user->id]) }}"> {{{ $post->user->username }}}</a></p>
    </div>

    <h4>Overview</h4>
    <div class="well">
      <table class="table">
        <tr>
          <td>Language</td>
          <td>{{{ $post->language }}}</td>
        </tr>
        @if ($post->skill)
        <tr>
          <td>Skill</td>
          <td>{{{ $post->skill->name }}}</td>
        </tr>
        @endif
        <tr>
          <td>Website</td> 
          <td>
          @if ($post->website)
            <a href="{{ $post->website }}" target="_blank">Visit Website</a>
          @endif
          </td>
        </tr>
        <tr>
          <td>Steamgroup</td>
          <td>
            @if ($post->steamgroup)
            <a href="{{ $post->steamgroup }}">Visit Steampage</a>
            @endif
          </td>
        </tr>
      </table>
    </div>

    <h4>What we play</h4>
    <div class="well">
      <ul>
      @foreach($post->lookingfors as $lookingfor)
        <li>{{$lookingfor->name}}</li>
      @endforeach
      </ul>
    </div>
    
    <h4>What we're looking for</h4>
    <div class="well">
      <ul>
      @foreach($post->playstyles as $playstyle)
        <li>{{$playstyle->name}}</li>
      @endforeach
      </ul>
    </div>
  </div>


<div class="col-md-8">
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