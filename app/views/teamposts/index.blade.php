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
    @if ($teamposts->count() == 0)
      <div class="well">Sorry. no teams at this time</div>
    @else
    @foreach($teamposts as $post)
      <div class="col-md-12" id="{{ $post->id.'id' }}">
        <div class="well post clearfix">
          <div class="col-md-2">
            <img src="{{ $post->owner->avatar }}" alt="avatar" class="img-rounded avatar">
          </div>
          <div class="col-md-10">
            <div class="row">
              <div class="col-md-9">
                <h2><a href="#" data-toggle="modal" data-target="#{{{ $post->id.'modal' }}}">{{ $post->owner->username }}</a></h2>
                @if( $post->region )
                <p class="region">{{{ $post->region->name }}}</p> - 
                @endif
                @if( strtotime($post->created_at) < strtotime('yesterday') )
                  {{{ date("m/d/y", strtotime( $post->created_at )) }}}
                @else
                  {{{ "Today at " . date("g:i A", strtotime( $post->created_at )) }}}
                @endif
              </div>
              <div class="col-md-3 text-right rating">
                @if ( $post->postcomments->count() != 0 )
                  <span>{{{ $post->postcomments->count() }}}</span><span class="glyphicon glyphicon-comment"></span>
                @endif
              </div>
            </div><!-- ./top-row -->
            <button class="btn btn-default btn-sm btn-post pull-right" data-toggle="modal" data-target="#{{{ $post->id.'modal' }}}">Open Team</button>
          </div>
        </div>
      </div>
    @endforeach
    @endif
  </div>
</div>

@stop