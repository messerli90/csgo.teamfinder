@extends('layouts.master')
@section('content')
<div class="row">

	<div class="jumbotron col-md-6 col-md-offset-3">
		<h1>{{ $user->username }}</h1>
			@if($user->bio)
				<p>{{ $user->bio }}</p>
			@endif
	</div>
	<div class="well col-md-6 col-md-offset-3">

	<div class="col-md-6">
		<h3>Services:</h3>
		@if($user->steam || $user->esea || $user->leetway || $user->altpug)
		<table class="table table-condensed">
			@if($user->steam)
				<p>
					<a href="{{ $user->steam }}"><img src="{{ asset('/img/ext_services/steam_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
				</p>
			@endif
			@if($user->esea)
				<p>
					<a href="{{ $user->esea }}"><img src="{{ asset('/img/ext_services/esea_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
				</p>
			@endif
			@if($user->leetway)
				<p>
					<a href="{{ $user->leetway }}"><img src="{{ asset('/img/ext_services/leetway_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
				</p>
			@endif
			@if($user->altpug)
				<p>
					<a href="{{ $user->altpug }}"><img src="{{ asset('/img/ext_services/altpug_logo_150.png') }}" class="serviceLink img-thumbnail"></a>
				</p>
			@endif
		</table>
		@else
			<p>This user doesn't use any third-party services.</p>
		@endif
	</div>
	<div class="col-md-6">
		<h3>Info:</h3>
		<table class="table table-condensed">
			@if($user->birthday)
			<tr>
				<td>Birthday</td>
				<td>{{ $user->birthday }}</td>
			</tr>
			@endif
			@if($user->region)
			<tr>
				<td>Region</td>
				<td>{{ $user->region->name }}</td>
			</tr>
			@endif
			@if($user->skill)
			<tr>
				<td>Skill</td>
				<td>{{ $user->skill->name }}</td>
			</tr>
			@endif
			@if($user->rank)
			<tr>
				<td>Rank</td>
				<td>{{ $user->rank->name }}</td>
			</tr>
			@endif
		</table>
	</div>




	</div>


</div>


@stop