@extends('layouts.master')
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="well">
      <h1>FAQ</h1>
      <hr>
      <h3>Topics</h3>
      <ul class="list-unstyled">
        <li><a href="#newaccount">How do I make an account?</a></li>
        <li><a href="#ranks">I don't know the name of my rank</a></li>
        <li><a href="#playstyles">What do the different Playstyles mean?</a></li>
        <li><a href="#skill">What do you mean by skill?</a></li>
      </ul>
      <hr>
      <h4 id="newaccount">How do I make an account?</h4>
        <blockquote>
          <small>To make an account just click on the 'Sign on with STEAM' link at the top. This will take you to Steam's secure authentication page where you log in using your Steam credentials. This will bring you back here to your new profile page. Be sure to update your personal info so people can see where you are from, your rank, age, etc.
          <br>
          CSGOTeamFinder will save your session and keep you logged in, to manually log out just click on your name and choose 'log out'</small>
        </blockquote>
      <hr>
      <h4 id="ranks">I don't know the name of my rank.</h4>
        <blockquote>
          Here are the ranks with their respective names:<br /><br />
          <div class="row">
            @foreach (Rank::all() as $rank)
            <div class="col-md-2 clearfix">
              <img src="{{ $rank->img }}" alt="{{ $rank->name }}" width="100"><small>{{$rank->name}}</small>
            </div>
            @endforeach
        </blockquote>
      <hr>
      <h4 id="playstyles">What do the different Playstyles mean?</h4>
        <blockquote>
          <h5><img src="{{ Playstyle::find(1)->img }}" alt="{{ Playstyle::find(1)->name }}" width="50">  {{ Playstyle::find(1)->name }}</h5>
            <small>The designated AWPer specializes in using his sniper rifle to get early picks and open up a site from long distance.</small>
          <h5><img src="{{ Playstyle::find(2)->img }}" alt="{{ Playstyle::find(2)->name }}" width="50">  {{ Playstyle::find(2)->name }}</h5>
            <small>The pointman. The guy that's first through the door, his fast reflexes help him get the opening kill on a sight. His job is also to relay information of oppositions positions if he dies.</small>
          <h5><img src="{{ Playstyle::find(3)->img }}" alt="{{ Playstyle::find(3)->name }}" width="50">  {{ Playstyle::find(3)->name }}</h5>
            <small>The supporter uses his smokes and flashes to get the entry fraggers into the site or hangs behind fraggers to work the trade if they fail to get the kill.</small>
          <h5><img src="{{ Playstyle::find(4)->img }}" alt="{{ Playstyle::find(4)->name }}" width="50">  {{ Playstyle::find(4)->name }}</h5>
            <small>Someone who holds the opposite side of the map to the bomb and holds back when others are taking the site to try and kill the rotators.</small>
          <h5><img src="{{ Playstyle::find(5)->img }}" alt="{{ Playstyle::find(5)->name }}" width="50">  {{ Playstyle::find(5)->name }}</h5>
            <small>The caller lets his team know what strats to play and where to go, he uses the informations from his team to make decisions.</small>
            <br><br><small>
                Have a better explanation? Let me know and I will edit these.
            </small>
        </blockquote>
      <hr>
      <h4 id="skill">What do you mean by skill?</h4>
        <blockquote>
          <small>If you were looking for an opponent (i.e. on IRC) what skill-level would you be looking for? Be honest with yourself and think in relation to the whole CS Community, not within your rank.</small>
        </blockquote>
      <hr>
      <h5>For any other questions you may have, feel free to drop me a line at <a href="mailto:knifelych@gmail.com">knifelych@gmail.com</a></h5>
    </div>
  </div>
</div>

@stop