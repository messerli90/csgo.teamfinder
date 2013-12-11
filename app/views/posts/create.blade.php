@extends('layouts.master')
@section('content')

<div class="well">
	<h1>Create new Post</h1>

	@if(Session::has('errors'))
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		</div>
	@endif

	{{ Form::open(['action' => 'PostController@store', 'class' => 'form-horizontal']) }}
		<div class="form-group">
			{{ Form::label('goal', 'Goal', ['class' => 'col-sm-2 control-label']) }}
			<div class="col-sm-10">
				{{ Form::textarea('goal', null, ['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('contact', 'Contact', ['class' => 'col-sm-2 control-label']) }}
			<div class="col-sm-10">
				{{ Form::textarea('contact', null, ['class' => 'form-control']) }}
			</div>
		</div>
		
		<div class="form-group">
			{{ Form::label('lookingfor[]', 'What are you looking for?', ['class' => 'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				@foreach($lookingfors as $lookingfor)
				<div class="checkbox">
					{{ Form::checkbox('lookingfors[]', $lookingfor->id) }}
					{{ Form::label('lookingfors[]', $lookingfor->name, ['class' => 'col-sm-12']) }}
				</div>
				@endforeach
			</div>
		</div>
		
		<div class="form-group">
			{{ Form::label('playstyles[]', 'Playstyle', ['class' => 'col-sm-2 control-label']) }}
			<div class="col-sm-6">
				@foreach($playstyles as $playstyle)
				<div class="checkbox">
					{{ Form::checkbox('playstyles[]', $playstyle->id) }}
					{{ Form::label('playstyles[]', $playstyle->name, ['class' => 'col-sm-12']) }}
				</div>
				@endforeach
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Post', ['class' => 'btn btn-primary']) }}
			</div>
		</div>
	{{ Form::close() }}
</div>
@stop