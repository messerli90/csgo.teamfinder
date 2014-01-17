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
								<td><strong>User</strong></td>
								<td><strong>Rank</strong></td>
								<td><strong>Status</strong></td>
								<td><strong>Action</strong></td>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>
									{{{ User::find($user->user_id)->username }}}
								</td>
								<td>
									@if(User::find($user->user_id)->rank->id < 19)
										<img src="{{ User::find($user->user_id)->rank->img }}" class="serviceLink">
									@else
										No Rank
									@endif
								</td>
								<td>
									@if (User::find($user->user_id)->status)
										{{{ User::find($user->user_id)->status->name }}}
									@else 
										No Status
									@endif
								</td>
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