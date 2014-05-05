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
  <div class="row">
    <div class="col-md-12">
    <h2>{{{ $user->username }}}'s Posts</h2>
      <div class="well">
        <h3>Posts</h3>
        @if($user->posts || $user->teamposts)
          <table class="table">
            <thead>
              <tr>
                <td class="col-md-1"><strong>Date Posted</strong></td>
                <td class="col-md-3"><strong>Goal</strong></td>
                <td class="col-md-2"><strong>Looking For</strong></td>
                <td class="col-md-3"><strong>Action</strong></td>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
              <tr>
                <td>
                  {{{ date("M d Y", strtotime($post->created_at)) }}}
                </td>
                <td>
                  {{{ $user->username }}}
                </td>
                <td>
                  @foreach ($post->lookingfors as $lookingfor)
                    <p>{{ $lookingfor->name }}</p>
                  @endforeach
                </td>
                <td>
                  <a href="{{ action('PostController@show', [$post->id])."#post" }}" class="btn btn-sm btn-post btn-info pull-left" >View Post</a>
                  @if(Auth::check())
                    @if(Auth::user()->id == $user->id)
                      <a href="{{ action('PostController@edit', [$post->id]) }}" class="btn btn-sm btn-post btn-success pull-left" >Edit Post</a>
                      {{ Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'DELETE', 'class' => 'pull-left']) }}
                        {{ Form::submit('Remove', ['class' => 'btn btn-danger btn-sm btn-post']) }}
                      {{ Form::close() }}
                      {{ Form::open(['action' => ['PostController@bump', $post->id], 'method' => 'PUT']) }}
                        {{ Form::submit('Bump Post', ['class' => 'btn btn-success btn-sm pull-right btn-post']) }}
                      {{ Form::close() }}

                    @endif
                  @endif
                </td>
              </tr>
              @endforeach
              @foreach ($teamposts as $teampost)
              <tr>
                <td>
                  {{{ date("M d Y", strtotime($teampost->created_at) ) }}}
                </td>
                <td>
                  {{{ $teampost->name }}}
                </td>
                <td>
                  @foreach($teampost->playstyles as $lookingfor)
                  <p><img src="{{ $lookingfor->img }}" alt="{{ $lookingfor->name }}" width="50"></p>
                  @endforeach
                </td>
                <td>
                  <a href="{{ action('TeampostController@show', [$teampost->id]) }}" class="btn btn-sm btn-post btn-info pull-left" >View Post</a>
                  @if(Auth::check())
                    @if(Auth::user()->id == $user->id)
                      <a href="{{ action('TeampostController@edit', [$teampost->id]) }}" class="btn btn-sm btn-post btn-success pull-left" >Edit Post</a>
                      {{ Form::open(['action' => ['TeampostController@destroy', $teampost->id], 'method' => 'DELETE', 'class' => 'pull-left']) }}
                        {{ Form::submit('Remove', ['class' => 'btn btn-danger btn-sm btn-post']) }}
                      {{ Form::close() }}
                      {{ Form::open(['action' => ['TeampostController@bump', $teampost->id], 'method' => 'PUT']) }}
                        {{ Form::submit('Bump Post', ['class' => 'btn btn-success btn-sm pull-right btn-post']) }}
                      {{ Form::close() }}
                    @endif
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p>This user hasn't been reviewed yet</p>
        @endif


      </div>
    </div>
  </div>
</div>


@stop