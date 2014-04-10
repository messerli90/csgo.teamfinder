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
    <h4>Partner Links</h4>
    <div class="well">
      <img src="{{ asset('img/ads/mumble.png') }}" alt="mumble logo" class="col-md-4 pull-left" />
      <h4>Free Mumble Server!</h4>
        <small>Found someone to play with but don't want to use in game voice? Check out this free to use Mumble server with your new party!</small>
        <br><br><small><strong>IP: </strong>csgoreddit.mumble.com</small>
        <br><small><strong>Port: </strong>5422</small>
    </div>
    <h4>Consider Donating</h4>
    <div class="well">
    <h5>Help keep CSGOTF alive</h5>
      <small>If this site has helped you or you just want to help support the development, please consider leaving a small donation.</small>
      <div class="col-md-6 col-md-offset-3 clearfix donate">
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="GDEBVYPPFHHLA">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
      </div>
      <div class="clearfix"></div>
    </div>

    <div class="well">
      <small>What do these Playstyle icons mean?</small>
      <br>
      <small><a href="/faq#playstyles">Check out the FAQ for descriptions</a></small>
    </div>
  </div>
  <div class="col-md-9" id="container">
  @if (false)
    <div class="well"><p>Sorry, no posts at this time</p></div>
  @else
  @foreach($posts as $post)
    <div class="col-md-12">
      <div class="post well clearfix">
        <div class="row top">
          <div class="col-md-2">
            <a href="{{ action('TeampostController@show', [$post->id]) }}">
              @if ($post->avatar)
                <img src="{{ $post->avatar }}" alt="{{ $post->name }} logo" class="img-rounded" width="80">
              @else 
                <img src="{{ asset('/img/teamposts/default.png') }}" alt="{{ $post->name }} logo" class="img-rounded" width="80">
              @endif
            </a>
          </div>
          <div class="col-md-6">
            <a href="{{ action('TeampostController@show', [$post->id]) }}">
              <h2>{{{ $post->name }}}</h2>
            </a>
            @if ($post->region)
              <small class="region">{{{ $post->region->name }}}</small>
            @endif
          </div>
          <div class="col-md-4 text-right">
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