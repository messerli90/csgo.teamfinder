<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">CS:GO Team Finder <sup class="alpha">Alpha</sup></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class=""><a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="active"><a href="{{ action('PostController@index') }}">Browse Players</a></li>
      <!--<li><a href="#">Find Team</a></li>-->
      <li><a href="{{ url('/about/') }}">About</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if (!Auth::check())
        <a href="{{ action('UserController@getLogin') }}" class="btn btn-default navbar-btn">Login</a>
        <a href="{{ action('UserController@create') }}" class="btn btn-default navbar-btn">Register</a>
      @else
        <p class="navbar-text">Signed in as <a href="{{ action('UserController@show', [Auth::user()->id]) }}" class="navbar-link">{{ Auth::user()->username }}</a></p>
        <a href="{{ action('UserController@getLogout') }}" class="btn btn-default navbar-btn pull-right">Logout</a>
        <a href="{{ action('UserController@edit', [Auth::user()->id]) }}" class="btn btn-default navbar-btn pull-right">Edit Profile</a>
      @endif
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>