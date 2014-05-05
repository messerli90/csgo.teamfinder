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
    <h4>Filter</h4>
    <div class="well">
      {{ Form::open(['action' => 'TeampostController@postFilter', 'class' => 'form-horizontal']) }}
        <div class="form-group">
        {{ Form::label('region', 'Region', ['class' => 'col-sm-4 small']) }}
          <div class="col-sm-8">
          @if (isset($region))
            {{ Form::select('region', ['Any', 'Regions' => $region_options], $region, ['class' => 'form-control input-sm']) }}
          @else 
            {{ Form::select('region', ['Any', 'Regions' => $region_options], null, ['class' => 'form-control input-sm']) }}
          @endif
          </div>
        </div>
        <div class="form-group">
        {{ Form::label('minskill', 'Minimum Skill', ['class' => 'col-sm-4 small']) }}
          <div class="col-sm-8">
            @if (isset($minskill))
              {{ Form::select('minskill', ['Any', 'Skill Levels' => $skill_options], $minskill, ['class' => 'form-control input-sm']) }}
            @else
            {{ Form::select('minskill', ['Any', 'Skill Levels' => $skill_options], null, ['class' => 'form-control input-sm']) }}
            @endif
          </div>
        </div>
        <div class="form-group">
        {{ Form::label('maxskill', 'Maximum Skill', ['class' => 'col-sm-4 small']) }}
          <div class="col-sm-8">
          @if (isset($maxskill))
            {{ Form::select('maxskill', ['Any', 'Skill Levels' => $skill_options], $maxskill, ['class' => 'form-control input-sm']) }}
          @else
            {{ Form::select('maxskill', ['Any', 'Skill Levels' => $skill_options], null, ['class' => 'form-control input-sm']) }}
          @endif
          </div>
        </div>
        <div class="form-group">
        {{ Form::label('playstyle', 'Playstyle', ['class' => 'col-sm-4 small']) }}
          <div class="col-sm-8">
          @if (isset($playstyle))
            {{ Form::select('playstyle', ['Any', 'Game Type' => $playstyle_options], $playstyle, ['class' => 'form-control input-sm']) }}
          @else 
            {{ Form::select('playstyle', ['Any', 'Game Type' => $playstyle_options], null, ['class' => 'form-control input-sm']) }}
          @endif
          </div>
        </div>
        {{ Form::submit('Apply', ['class' => 'btn btn-primary'])}}
      {{ Form::close() }}
    </div>
    <div class="hidden-xs">
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
    </div>

    <div class="well">
      <small>What do these Playstyle icons mean?</small>
      <br>
      <small><a href="/faq#playstyles">Check out the FAQ for descriptions</a></small>
    </div>
  </div>
  <div class="col-md-7" id="container">
  @if (false)
    <div class="well"><p>Sorry, no posts at this time</p></div>
  @else
  @foreach($teamposts as $post)
    <div class="col-md-12">
      <div class="post well clearfix">
        <div class="row top">
          <div class="col-md-2 hidden-xs">
            <a href="{{ action('TeampostController@show', [$post->id]) }}">
              @if ($post->avatar)
                <img src="{{ $post->avatar }}" alt="{{ $post->teamname }} logo" class="img-rounded" width="80">
              @else 
                <img src="{{ asset('/img/teamposts/default.png') }}" alt="{{ $post->teamname }} logo" class="img-rounded" width="80">
              @endif
            </a>
          </div>
          <div class="col-md-6 col-xs-12">
            <a href="{{ action('TeampostController@show', [$post->id]) }}">
              <h2>{{{ $post->teamname }}}</h2>
            </a>
              <small class="region">{{{ date("M d", strtotime(Teampost::find($post->id)->created_at)) }}}</small>
            @if ($post->region)
              <small class="region">{{{ $post->region }}}</small>
            @endif
          </div>
          <div class="col-md-4 col-xs-12 text-right">
          <h5 class="small-caps roles-title">Looking for</h5>
          @foreach(Teampost::find($post->id)->playstyles as $playstyle)
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
        @if (Teampost::find($post->id)->teampostcomments->count() != 0)
          <a href="{{ action('TeampostController@show', [$post->id]) }}#comments" class="comments"><small>{{{ Teampost::find($post->id)->teampostcomments->count() }}} <span class="glyphicon glyphicon-comment"></span></small></a>
        @endif
        </div>
      </div>
    </div>
    @endforeach
    </div>
    <div class="col-md-2 hidden-xs">
      <div class="well">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- Sidebar2 -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:120px;height:600px"
             data-ad-client="ca-pub-0223519100876576"
             data-ad-slot="7604303736"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>
    </div>
  </div>

    <!-- Pagination -->
    <div class="col-md-6 col-md-offset-4 col-xs-12 clearfix">
      {{ $teamposts->links() }}     
    </div>
    @endif
  </div>
</div>

@stop