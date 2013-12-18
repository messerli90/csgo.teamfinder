@extends('layouts.master')
@section('content')
<div class="well">
<h1>Edit {{ $user->username }}</h1>

@if(Session::has('errors'))
	<div class="alert alert-warning">
		@foreach($errors->all() as $error)
			<p><span class="glyphicon glyphicon-remove-sign"></span> {{ $error }}</p>
		@endforeach
	</div>
@endif

{{ Form::model($user, ['action' => ['UserController@update', $user->id], 'method' => 'put', 'files' => true, 'class' => 'form-horizontal']) }}
<!--
<div class="form-group">
	{{ Form::label('avatar', 'Avatar', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::file('avatar', ['class' => 'form-control']) }}
	</div>
</div>
-->
@if($user->birthday)
<div class="form-group">
	{{ Form::label('birthday', 'Birthday', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::selectRange('day', 1, 31, $birthday[2], ['class' => 'form-control']) }}	
		{{ Form::selectMonth('month', $birthday[1], ['class' => 'form-control']) }}
		{{ Form::selectRange('year', 2013, 1950, $birthday[0], ['class' => 'form-control']) }}
	</div>
</div>
@else
<div class="form-group">
	{{ Form::label('birthday', 'Birthday', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::selectRange('day', 1, 31, null, ['class' => 'form-control']) }}	
		{{ Form::selectMonth('month', null, ['class' => 'form-control']) }}
		{{ Form::selectRange('year', 2013, 1950, null, ['class' => 'form-control']) }}
	</div>
</div>
@endif

<div class="form-group">
	{{ Form::label('steam', 'steam', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::text('steam', null, ['class' => 'form-control', 'placeholder' => 'http://steamcommunity.com/id/1337xSc0pe']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('rank', 'Rank', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::select('rank', $rank_options, $user->rank_id, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('skill', 'Skill', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::select('skill', $skill_options, $user->skill_id, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('esea', 'esea', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::text('esea', null, ['class' => 'form-control', 'placeholder' => 'http://play.esea.net/users/00000']) }}
	</div>
</div>

<div class="form-group">	
	{{ Form::label('leetway', 'leetway', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::text('leetway', null, ['class' => 'form-control', 'placeholder' => 'http://www.leetway.com/profile/user/00000']) }}
	</div>
</div>

<div class="form-group">	
	{{ Form::label('altpug', 'altpug', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::text('altpug', null, ['class' => 'form-control', 'placeholder' => 'http://www.altpug.com/Stats/User/00000']) }}
	</div>
</div>

<div class="form-group">
	
	{{ Form::label('region_id', 'Region', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::select('region_id', $region_options, $user->region_id, ['class' => 'form-control']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('Voips', 'VoiP', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		@foreach($voips as $voip)
		<div class="checkbox">
			<label class="col-sm-12">
				{{ Form::checkbox('voips[]', $voip->id) }}
				<span class="col-sm-2">{{ $voip->name }}</span>
			</label>
		</div>
		@endforeach
	</div>
</div>

<div class="form-group">
	{{ Form::label('bio', 'Short Bio', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::textarea('bio', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'I like to shoot things in the head and plant bombs.']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('experience', 'Experience', ['class' => 'col-sm-2 control-label']) }}
	<div class="col-sm-10">
		{{ Form::textarea('experience', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => "I used to play CAL with Team X... "]) }}
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		{{ Form::submit('Edit', ['class' => 'btn btn-primary']) }}
	</div>
</div>
{{ Form::close() }}
</div>

<script type="text/javascript">
	$('.datepicker').datepicker();
</script>
@stop