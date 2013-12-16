@extends('layouts.master')
@section('content')


<h1>Review {{$user->username }}</h1>
@if(Session::has('errors'))
	<div class="alert alert-warning col-md-8">
		@foreach($errors->all() as $error)
			<p><span class="glyphicon glyphicon-remove-sign"></span> {{ $error }}</p>
		@endforeach
	</div>
@endif

<div class="row">
	<div class="col-md-8">
		<div class="well">
			{{ Form::open([action('UserController@postReview', [$user->id]), 'class' => 'form-horizontal']) }}
			<div class="form-group">
				{{ Form::label('rating', 'Rating', ['class' => 'col-sm-2 control-label'])}}
				<div class="col-sm-10">
					<div class="radio">
						<label class="btn btn-success">
							{{ Form::radio('score', '1')}}
							<span class="glyphicon glyphicon-thumbs-up"></span> Good
						</label>
					</div>
					<br />
					<div class="radio">
						<label class="btn btn-danger">
							{{ Form::radio('score', '-1')}}
							<span class="glyphicon glyphicon-thumbs-down"></span> Bad	
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('review', 'Review', ['class' => 'col-sm-2 control-label']) }}
				<div class="col-sm-10">	
					{{ Form::textarea('review', null, ['class' => 'form-control']) }}
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
</div>

@stop