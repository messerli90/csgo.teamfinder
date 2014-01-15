@extends('layouts.master')
@section('content')

<div class="well">
	<h1>Create new Post</h1>

	@if(Session::has('errors'))
	<div class="alert alert-warning">
		@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
	</div>
	@endif

	{{ Form::open(['action' => 'PostController@store', 'class' => 'form-horizontal']) }}
		<div class="form-group">
			{{ Form::label('goal', 'Goal', ['class' => 'col-sm-2 control-label']) }}
			<div class="col-sm-10">
				{{ Form::textarea('goal', null, ['class' => 'form-control', 'placeholder' => "I'm looking for a team to join a league with... I just want some friendly people to play MM with..."]) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('contact', 'Contact', ['class' => 'col-sm-2 control-label']) }}
			<div class="col-sm-10">
				{{ Form::textarea('contact', null, ['class' => 'form-control', 'placeholder' => "You should get a hold of me through steam... Call me on skype at xxx... I'm usually home from 5-9PM...."]) }}
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				<div class="form-group">
					{{ Form::label('lookingfor[]', 'What are you looking for?', ['class' => 'col-sm-4 control-label']) }}
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
			<div class="col-md-4">
				<div class="form-group">
					{{ Form::label('playstyles[]', 'Playstyle', ['class' => 'col-sm-3 control-label']) }}
					<div class="col-sm-6">
						@foreach($playstyles as $playstyle)
						<div class="checkbox">
							<label>
								{{ Form::checkbox('playstyles[]', $playstyle->id) }}
								<span class="col-sm-12">{{ $playstyle->name }}</span>
							</label>
						</div>
						@endforeach
					</div>
				</div>
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
