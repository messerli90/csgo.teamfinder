<h1>Edit {{ $user->username }}</h1>

@if(Session::has('errors'))
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
	</div>
@endif

{{ Form::model($user, ['action' => ['UserController@update', $user->id], 'method' => 'put', 'files' => true]) }}

<p>
	{{ Form::label('avatar', 'Avatar') }}
	{{ Form::file('avatar') }}
</p>
<p>
	{{ Form::label('birthday', 'Birthday') }}
	{{ Form::selectRange('day', 1, 31, $birthday[2]) }}	
	{{ Form::selectMonth('month', $birthday[1]) }}
	{{ Form::selectRange('year', 2013, 1950, $birthday[0]) }}
</p>
<p>
	
	{{ Form::label('steam', 'steam') }}
	{{ Form::text('steam') }}
</p>
<p>
	
	{{ Form::label('rank', 'Rank') }}
	{{ Form::select('rank', $rank_options, $user->rank_id) }}
</p>
<p>
	
	{{ Form::label('skill', 'Skill') }}
	{{ Form::select('skill', $skill_options, $user->skill_id) }}
</p>
<p>
	
	{{ Form::label('esea', 'esea') }}
	{{ Form::text('esea') }}
</p>
<p>
	
	{{ Form::label('leetway', 'leetway') }}
	{{ Form::text('leetway') }}
</p>
<p>
	
	{{ Form::label('altpug', 'altpug') }}
	{{ Form::text('altpug') }}
</p>
<p>
	
	{{ Form::label('region_id', 'Region') }}
	{{ Form::select('region_id', $region_options, $user->region_id) }}
</p>
<p>
	{{ Form::label('voips[]', 'VoiP') }}
	@foreach($voips as $voip)
	<p>
		{{ Form::checkbox('voips[]', $voip->id) }}
		{{ Form::label('voips[]', $voip->name) }}
	</p>
	@endforeach

</p>
<p>
	{{ Form::label('bio', 'Short Bio') }}
	{{ Form::textarea('bio') }}
</p>
<p>
	{{ Form::submit('Edit') }}
</p>
{{ Form::close() }}