@extends('layouts.master')
@section('content')
<div class="row">
  @if (Session::has('message'))
    <div class="col-md-10 col-md-offset-1">
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('message') }}
      </div>
    </div>
  @endif


  <div class="col-md-12">
    <div class="visible-xs col-xs-12">
      <div class="well">
        <img src="{{ $user->avatar }}" class="img-rounded col-xs-12">  
        <h2 class="text-center">{{{ $user->username }}}</h2>
        <hr>
        <p class="text-center">{{ $user->bio }}</p>
      </div>
    </div>
    <div class="col-md-3 col-xs-12">
      <h4>Quick Links</h4>
      <div class="well text-center">
        <p>
          <a href="http://csgo-stats.com/{{{ $user->id }}}" target="_blank"><img src="{{ asset('/img/ext_services/csgo-stats_logo.png' )}}" class="serviceLink"></a>
        </p>
        <p>
          <a href="http://steamcommunity.com/profiles/{{{ $user->id }}}" target="_blank"><img src="{{ asset('/img/ext_services/steam_logo_150.png' )}}" class="serviceLink img-thumbnail"></a>
        </p>
        @if($user->esea || $user->leetway || $user->altpug)
          @if($user->esea)
            <p>
              <a href="{{ $user->esea }}"><img src="{{ asset('/img/ext_services/esea_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
            </p>
          @endif
          @if($user->leetway)
            <p>
              <a href="{{ $user->leetway }}"><img src="{{ asset('/img/ext_services/leetway_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
            </p>
          @endif
          @if($user->altpug)
            <p>
              <a href="{{ $user->altpug }}"><img src="{{ asset('/img/ext_services/altpug_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
            </p>
          @endif
        @endif
        <hr>
        {{ Form::open(['action' => ['ShortlistController@update', $user->id], 'method' => 'put']) }}
          {{ Form::submit('Add to Shortlist', ['class' => 'btn btn-primary  btn-block']) }}
        {{ Form::close() }}
      </div>
      <h4>Info</h4>
      <div class="well">
        <table class="table">
          <tr>
            <td>Status</td>
            <td>{{{ $user->status->name }}}</td>
          </tr>
          <tr>
            <td>Rating</td>
            <td>
              @if($user->rating >= 0)
                <span class="good">{{ $user->rating }} <span class="glyphicon glyphicon-thumbs-up"></span></span>
              @else
                <span class="bad">{{ $user->rating }} <span class="glyphicon glyphicon-thumbs-down"></span></span>
              @endif
            </td>
          </tr>
          @if($user->birthday)
          <tr>
            <td>Age</td>
            <td>{{ date("Y-m-d")-date($user->birthday) }}</td>
          </tr>
          @endif
          @if($user->region)
          <tr>
            <td>Region</td>
            <td>{{ $user->region->name }}</td>
          </tr>
          @endif
          @if($user->skill)
          <tr>
            <td>Skill</td>
            <td>{{ $user->skill->name }}</td>
          </tr>
          @endif
          @if($user->rank)
          <tr>
            <td>Matchmaking Rank</td>
            <td><img src="{{ $user->rank->img }}" alt="{{ $user->rank->name }}" class="serviceLink"> </td>
          </tr>
          @endif
          @if($user->voips)
          <tr>
            <td>VoIP Services</td>
            <td>
              @foreach ($user->voips as $voip)
              <p>{{ $voip->name }}</p>
              @endforeach
            </td>
          </tr>
          @endif
        </table>
      </div>
    </div>

    <div class="col-md-9">
    <h4>Control Panel</h4>
      @if (Auth::check())
        @if (Auth::user()->id == $user->id)
          <div class="panel">
            <div class="panel-body">
              <a href="{{ action('UserController@edit', [$user->id]) }}" class="btn btn-success">Edit Profile</a>
              <a href="{{ route('shortlist.index') }}" class="btn btn-default">View Shortlist</a>
              {{ Form::open(['action' => ['UserController@postResync', $user->id], 'method' => 'post', 'class' => 'form-inline pull-right']) }}
                {{ Form::submit('Resync Profile with Steam', ['class' => 'btn btn-primary']) }}
              {{ Form::close() }}
              {{ Form::open(['action' => ['UserController@postStatus', $user->id], 'method' => 'post', 'class' => 'form-inline pull-right']) }}
                <div class="form-group">
                  {{ Form::select('status', $status_options, $user->status_id, ['class' => 'form-control ']) }}       
                </div>
                {{ Form::submit('Change Status', ['class' => 'btn btn-default btn-post']) }}
            {{ Form::close() }}
            </div>
          </div>
        @endif
      @endif

      <div class="well clearfix hidden-xs">
        <img src="{{ $user->avatar }}" class="img-rounded col-md-3">  
        <h1>{{{ $user->username }}}</h1>
        <p>{{ $user->bio }}</p>
      </div>
      @if ($user->experience)
      <h3>Experience</h3>
        <div class="well">
          <p>{{ $parsedown->text($user->experience) }}</p>
        </div>
      @endif
      <h3>Reviews <a href="{{ action('UserController@getReview', [$user->id]) }}" class="btn btn-primary pull-right">Leave a Review</a></h3>
      <div class="well">
        <table class="table">
        @if ( count($user->ratings) > 0 )
          <thead>
            <tr>
              <td>Author</td>
              <td>Review</td>
              <td>Rating</td> 
            </tr>
          </thead>
          <tbody>
            @foreach ($user->ratings as $rating)
            <tr>
              <td><a href="{{ action('UserController@show', [User::find($rating->author_id)->id]) }}">{{ User::find($rating->author_id)->username }}</a> </td>
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
          @else 
          <p>This user has no reviews yet</p>
          @endif
        </table>
      </div>
    </div>
  </div> <!-- ./ row -->
  @yield('post')
</div>
@stop