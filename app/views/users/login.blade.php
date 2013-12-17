@extends('layouts.master')
@section('content')

<div class="row">
	<div class="col-md-5">
		<div class="well">
			<h1>Login</h1>
			@if(Session::has('error'))
				<p>Email / Password combination invalid</p>
			@endif

			{{ Form::open(['action' => 'UserController@postLogin', 'class' => 'form-horizontal']) }}
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
					<div class="col-sm-offset-2 col-sm-4">
						{{ Form::submit('Login', ['class' => 'btn btn-primary']) }}
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>	
</div>

@stop