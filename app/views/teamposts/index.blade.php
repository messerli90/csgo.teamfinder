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
  <div class="col-md-2">
    <div class="well">
      <a href="{{ action('TeampostController@create') }}" class="btn btn-primary">Add new Team</a>
    </div>
  </div>
  <div class="col-md-8" id="container">
    @if (is_null($teamposts))
      <div class="well">Sorry. no teams at this time</div>
    @else
    @foreach($teamposts as $post)
      <div class="col-md-12" id="{{ $post->id.'id' }}">
        <div class="well post clearfix row">
          <div class="col-md-2">
            <img src="{{ $post->avatar }}" alt="avatar" class="img-rounded avatar">
          </div>
          <div class="col-md-10">
            <div class="row">
              <div class="col-md-9">
                <h2><a href="#" data-toggle="modal" data-target="#{{{ $post->id.'modal' }}}">{{ $post->name }}</a></h2>
                @if( $post->region )
                <p class="region">{{{ $post->region->name }}} - 
                @endif
                @if( strtotime($post->created_at) < strtotime('yesterday') )
                  {{{ date("m/d/y", strtotime( $post->created_at )) }}}
                @else
                  {{{ "Today at " . date("g:i A", strtotime( $post->created_at )) }}}</p>
                @endif
              </div>
              <div class="col-md-3 text-right rating">
                @if ( count($post->postcomments) != 0 )
                  <span>{{{ count($post->postcomments). " " }}}</span><span class="glyphicon glyphicon-comment"></span>
                @endif
              </div>
            </div><!-- ./top-row -->
            <div class="row">
              <div class="col-md-5">
                <p><strong>Type of Team</strong></p>
                @if( $post->lookingfors )
                  <ul>
                    @foreach ($post->lookingfors as $lookingfor)
                      <li>{{ $lookingfor->name }}</li>
                    @endforeach
                  </ul>
                @endif
              </div>
              <div class="col-md-7">
                <p class="text-center"><strong>Looking for</strong></p>
                @if( $post->playstyles )
                  @foreach($post->playstyles as $playstyle)
                    <div class="roles text-center">
                    <img src="{{ asset($playstyle->img) }}"  class="role-icons" alt="...">
                      <div class="caption">
                        <small>{{ $playstyle->name }}</small>
                      </div>
                    </div>
                  @endforeach
                @endif
              </div>
            </div><!-- ./mid row -->
          </div>
          <div class="col-md-12">
            @if(Auth::check())
              @if(Auth::user()->id == $post->user->id)
                {{ Form::open(['action' => ['TeampostController@destroy', $post->id], 'method' => 'DELETE']) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-post pull-right']) }}
                {{ Form::close() }}
                <a type="button" href="{{ action('TeampostController@edit', [$post->id]) }}" class="btn btn-sm btn-default btn-post pull-right">Edit</a>
              @endif
            @endif
            <button class="btn btn-default btn-sm btn-post pull-left" data-toggle="modal" data-target="#{{{ $post->id.'modal' }}}">Open Team</button>
          </div><!-- ./bottom row -->
        </div>
      </div>
    @endforeach

    <!-- Pagination -->
    <div class="col-md-6 col-md-offset-4 clearfix">
      {{ $teamposts->links() }}     
    </div>
    @endif
  </div>
</div>

@stop