@extends('layouts.master')
@section('content')

@if(Session::has('errors'))
	<div class="alert alert-warning">
		@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
	</div>
	</div>
@endif
<div class="well col-md-6">
{{ Form::open(['action' => 'UserController@store', 'class' => 'form-horizontal']) }}

	<div class="form-group">
		{{ Form::label('username', 'Username', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::text('username', null, ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::email('email', null, ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::password('password', ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-6">
			{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			{{ Form::submit('Register', ['class' => 'btn btn-primary']) }}
		</div>
	</div>
{{ Form::close() }}
</div>
@stop