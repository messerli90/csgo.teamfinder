@extends('layouts.master')
@section('content')

<div class="col-md-10 well">
  <h1>Create new Team post</h1>
  <hr>
  @if(Session::has('errors'))
  <div class="alert alert-warning">
    @foreach($errors->all() as $error)
      <p>{{ $error }}</p>
    @endforeach
  </div>
  @endif
  <div class="row clearfix">
  {{ Form::open(['action' => 'TeampostController@store', 'class' => 'form-horizontal']) }}
    <div class="form-group">
      {{ Form::label('teamname', 'Team Name *', ['class' => 'col-sm-2 control-label']) }}
      <div class="col-sm-3">
        {{ Form::text('teamname', null, ['class' => 'form-control', 'placeholder' => 'Ninjas in Pyjamas']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('teamavatar', 'Avatar URL', ['class' => 'col-sm-2 control-label']) }}
      <div class="col-sm-3">
        {{ Form::text('teamavatar', null, ['class' => 'form-control', 'placeholder' => '']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('teamwebsite', 'Website URL', ['class' => 'col-sm-2 control-label']) }}
      <div class="col-sm-3">
        {{ Form::text('teamwebsite', null, ['class' => 'form-control', 'placeholder' => '']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('steamgroup', 'Steam Group URL', ['class' => 'col-sm-2 control-label']) }}
      <div class="col-sm-3">
        {{ Form::text('steamgroup', null, ['class' => 'form-control', 'placeholder' => '']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('region_id', 'Region *', ['class' => 'col-sm-2 control-label']) }}
      <div class="col-sm-3">
        {{ Form::select('region_id', $region_options, 2, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('skill_id', 'Skill', ['class' => 'col-sm-2 control-label']) }}
      <div class="col-sm-3">
        {{ Form::select('skill_id', $skill_options, 3, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('language', 'Language', ['class' => 'col-sm-2 control-label']) }}
      <div class="col-sm-3">
        {{ Form::text('language', null, ['class' => 'form-control', 'placeholder' => 'English']) }}
      </div>
    </div>
    <div class="form-group">
      {{ Form::label('league', 'League', ['class' => 'col-sm-2 control-label']) }}
      <div class="col-sm-3">
        {{ Form::text('league', null, ['class' => 'form-control', 'placeholder' => 'English']) }}
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          {{ Form::label('lookingfor[]', 'What does your team play? *', ['class' => 'col-sm-4 control-label']) }}
          <div class="col-sm-6">
            @foreach($lookingfors as $lookingfor)
            <div class="radio">
              <label>
                {{ Form::radio('lookingfors[]', $lookingfor->id) }}
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
        {{ Form::textarea('info', null, ['class' => 'form-control', 'rows' => '6', 'placeholder' => "We play CAL... "]) }}
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        {{ Form::submit('Post', ['class' => 'btn btn-primary']) }}
      </div>
    </div>

  {{ Form::close() }}
  </div>

</div>
@stop