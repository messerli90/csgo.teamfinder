@extends('layouts.master')
@section('content')

<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="well">
      <h1>Edit Post</h1>

      @if(Session::has('errors'))
      <div class="alert alert-warning">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
      @endif

      {{ Form::model($post, ['action' => ['TeampostController@update', $post->id], 'method' => 'put', 'class' => 'form-horizontal']) }}
        <div class="form-group">
          {{ Form::label('teamname', 'Team Name *', ['class' => 'col-sm-2 control-label']) }}
          <div class="col-sm-3">
            {{Form::text('teamname', $post->name, ['class' => 'form-control']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('teamavatar', 'Avatar URL', ['class' => 'col-sm-2 control-label']) }}
          <div class="col-sm-3">
            {{ Form::text('teamavatar', $post->avatar, ['class' => 'form-control', 'placeholder' => '']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('teamwebsite', 'Website URL', ['class' => 'col-sm-2 control-label']) }}
          <div class="col-sm-3">
            {{ Form::text('teamwebsite', $post->website, ['class' => 'form-control', 'placeholder' => '']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('steamgroup', 'Steam Group URL', ['class' => 'col-sm-2 control-label']) }}
          <div class="col-sm-3">
            {{ Form::text('steamgroup', $post->steamgroup, ['class' => 'form-control', 'placeholder' => '']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('region_id', 'Region *', ['class' => 'col-sm-2 control-label']) }}
          <div class="col-sm-3">
            {{ Form::select('region_id', $region_options, $post->region_id, ['class' => 'form-control']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('skill_id', 'Skill', ['class' => 'col-sm-2 control-label']) }}
          <div class="col-sm-3">
            {{ Form::select('skill_id', $skill_options, $post->skill_id, ['class' => 'form-control']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('language', 'Language', ['class' => 'col-sm-2 control-label']) }}
          <div class="col-sm-3">
            {{ Form::text('language', $post->language, ['class' => 'form-control', 'placeholder' => 'English']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('league', 'League', ['class' => 'col-sm-2 control-label']) }}
          <div class="col-sm-3">
            {{ Form::text('league', $post->league, ['class' => 'form-control', 'placeholder' => 'CEVO, ESEA']) }}
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('lookingfor[]', 'What does your team play? *', ['class' => 'col-sm-4 control-label']) }}
              <div class="col-sm-6">
                @foreach($lookingfors as $lookingfor)
                <div class="checkbox">
                  <label>
                    {{ Form::checkbox('lookingfors[]', $lookingfor->id) }}
                    <span class="col-sm-12">{{ $lookingfor->name }}</span>
                  </label>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {{ Form::label('playstyles[]', 'What type of player are you looking for? *', ['class' => 'col-sm-4 control-label']) }}
              <div class="col-sm-6">
                @foreach($playstyles as $playstyle)
                <div class="checkbox">
                  <label>
                    {{ Form::checkbox('playstyles[]', $playstyle->id) }}
                    <span class="col-sm-12 ">{{ $playstyle->name }}</span>
                  </label>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('info', 'Additional Info about your team *', ['class' => 'col-sm-2 control-label']) }}
          <div class="col-sm-8">
            {{ Form::textarea('info', $post->info, ['class' => 'form-control', 'rows' => '6', 'placeholder' => "We play CAL... "]) }}
          <small><a href="#" onclick="return markdownHelp()">Formatting Help</a></small>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            {{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}
          </div>
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>

@stop