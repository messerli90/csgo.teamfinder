@extends('layouts.master')
@section('content')

@if(Session::has('errors'))
	<div class="alert alert-warning">
		@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
		@endforeach
	</div>
@endif
<div class="well col-md-5">
<h1>Register an account</h1>
{{ Form::open(['action' => 'UserController@store', 'class' => 'form-horizontal']) }}

	<div class="form-group">
		{{ Form::label('username', 'Username', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::text('username', null, ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::email('email', null, ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::password('password', ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-sm-2 control-label']) }}
		<div class="col-sm-10">
			{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-4">
			{{ Form::submit('Register', ['class' => 'btn btn-primary']) }}
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<hr>	
			<p>Already have an account?</p>
			<a href="{{ action('UserController@getLogin') }}" class="btn btn-default">Login</a>
		</div>		
	</div>
{{ Form::close() }}
</div>
@stop