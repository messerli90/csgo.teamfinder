@extends('layouts.master')
@section('content')

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
      <a href="{{ action('TeampostController@create') }}" class="btn btn-primary">Add new Team</a>
    </div>
  </div>
  <div class="col-md-7" id="container">
  @if (false)
    <div class="well"><p>Sorry, no posts at this time</p></div>
  @else
  @foreach($posts as $post)
    <div class="col-md-12">
      <div class="post well clearfix">
        <div class="row top">
          <div class="col-md-2">
            <a href="{{ action('TeampostController@show', [$post->id]) }}">
              <img src="{{ $post->avatar }}" alt="{{ $post->name }} logo" class="img-rounded" width="80">
            </a>
          </div>
          <div class="col-md-7">
            <a href="{{ action('TeampostController@show', [$post->id]) }}">
              <h2>{{{ $post->name }}}</h2>
            </a>
            @if ($post->region)
              <small class="region">{{{ $post->region->name }}}</small>
            @endif
          </div>
          <div class="col-md-3 text-right">
          <h5 class="small-caps roles-title">Looking for</h5>
          @foreach($post->playstyles as $playstyle)
            <div class="roles">
            <img src="{{ asset($playstyle->img) }}"  class="lookingfor" alt="{{{ $playstyle->name }}}">
              <div class="caption">
                <small>{{ $playstyle->name }}</small>
              </div>
            </div>
          @endforeach
          </div>
        </div><!-- ./top row -->
        <div class="bottom text-right">
        @if ($post->teampostcomments->count() != 0)
          <a href="{{ action('TeampostController@show', [$post->id]) }}#comments" class="comments"><small>{{{ $post->teampostcomments->count() }}} <span class="glyphicon glyphicon-comment"></span></small></a>
        @endif
        @if(Auth::check())
          @if(Auth::user()->id == $post->user->id)
            {{ Form::open(['action' => ['TeampostController@destroy', $post->id], 'method' => 'DELETE']) }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-post pull-right']) }}
            {{ Form::close() }}
            <a type="button" href="{{ action('TeampostController@edit', [$post->id]) }}" class="btn btn-sm btn-default btn-post pull-right">Edit</a>
          @endif
        @endif
        </div>
      </div>
    </div>
    @endforeach
    </div>
  </div>


    <!-- Pagination -->
    <div class="col-md-6 col-md-offset-4 clearfix">
      {{ $posts->links() }}     
    </div>
    @endif
  </div>
</div>

@stop