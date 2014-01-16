@extends('layouts.master')
@section('content')
<div class="row">
	@if (Session::has('message'))
		<div class="col-md-10 col-md-offset-1">
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ Session::get('message') }}
			</div>
		</div>
	@endif
	<div class="row">
		<div class="col-md-8">
			<div class="well">
				<h2>{{{ $author->username }}}'s Shortlist</h2>

				@if($author->shortlists)
					<table class="table">
						<thead>
							<tr>
								<td>Author</td>
								<td>User</td>
								<td>Action</td>	
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td><a href="{{ action('UserController@show', [Auth::user()->id]) }}">{{ User::find($user->author_id)->username }}</a> </td>
								<td>{{{ User::find($user->user_id)->username }}}</td>
								<td>
									@if(Auth::check())
										@if(Auth::user()->id == $author->id)
											{{ Form::open(['action' => ['ShortlistController@destroy', $user->id], 'method' => 'DELETE']) }}
											{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-post']) }}
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