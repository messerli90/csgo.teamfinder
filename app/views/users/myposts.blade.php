@extends('layouts.master')
@section('content')

<div class="col-md-12">
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
          <table class="table table-condensed">
            <thead>
              <tr>
                <td class="col-md-1"><strong>Last Bumped</strong></td>
                <td class="col-md-1"><strong>Type</strong></td>
                <td class="col-md-6"><strong>Comments</strong></td>
                <td class="col-md-4"><strong>Action</strong></td>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
              <tr>
                <td>
                  {{{ date("M d Y", strtotime($post->bumped_at)) }}}
                </td>
                <td>
                  <p>Player Post</p>
                </td>
                <td>
                  @if (count($post->postcomments))
                    @foreach ($post->postcomments as $comment)
                      <blockquote class="myposts-comments">{{ $parsedown->text($comment->comment) }}
                        <footer><a href="{{ action('UserController@show', [$comment->author_id]) }}">{{ User::find($comment->author_id)->username }}</a></footer>
                      </blockquote>
                    @endforeach
                  @else
                    <p>No Comments</p>
                  @endif
                </td>
                <td>
                  <a href="{{ action('PostController@show', [$post->id])."#post" }}" class="btn btn-sm btn-post btn-info pull-left action-buttons" >View Post</a>
                  @if(Auth::check())
                    @if(Auth::user()->id == $user->id)
                      <a href="{{ action('PostController@edit', [$post->id]) }}" class="btn btn-sm btn-post btn-success pull-left action-buttons" >Edit Post</a>
                      {{ Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'DELETE', 'class' => 'pull-left']) }}
                        {{ Form::submit('Remove', ['class' => 'btn btn-danger btn-sm btn-post action-buttons']) }}
                      {{ Form::close() }}
                      {{ Form::open(['action' => ['PostController@bump', $post->id], 'method' => 'PUT']) }}
                        {{ Form::submit('Bump Post', ['class' => 'btn btn-primary btn-sm btn-post action-buttons']) }}
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
                  <p>Teampost</p>
                </td>
                <td>
                  @if (count($teampost->teampostcomments))
                    @foreach ($teampost->teampostcomments as $comment)
                      <blockquote class="myposts-comments">{{ $parsedown->text($comment->comment) }}
                        <footer><a href="{{ action('UserController@show', [$comment->author_id]) }}">{{ User::find($comment->author_id)->username }}</a></footer>
                      </blockquote>
                    @endforeach
                  @else
                    <p>No Comments</p>
                  @endif
                </td>
                <td>
                  <a href="{{ action('TeampostController@show', [$teampost->id]) }}" class="btn btn-sm btn-post btn-info pull-left action-buttons" >View Post</a>
                  @if(Auth::check())
                    @if(Auth::user()->id == $user->id)
                      <a href="{{ action('TeampostController@edit', [$teampost->id]) }}" class="btn btn-sm btn-post btn-success pull-left action-buttons" >Edit Post</a>
                      {{ Form::open(['action' => ['TeampostController@destroy', $teampost->id], 'method' => 'DELETE', 'class' => 'pull-left']) }}
                        {{ Form::submit('Remove', ['class' => 'btn btn-danger btn-sm btn-post action-buttons']) }}
                      {{ Form::close() }}
                      {{ Form::open(['action' => ['TeampostController@bump', $teampost->id], 'method' => 'PUT']) }}
                        {{ Form::submit('Bump Post', ['class' => 'btn btn-primary btn-sm  btn-post action-buttons']) }}
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