<h1>Posts</h1>
<a href="{{ action('PostController@create') }}">Add new Post</a>
@if ($posts->isEmpty())
	<p>Sorry, no posts at this time</p>
@else
<table>
	<tr>
		<td>ID</td>
		<td>Username</td>
		<td>Goal</td>
		<td>Rank</td>
		<td>Action</td>
	</tr>
	@foreach($posts as $post)
	<tr>
		<td>{{ $post->id }}</td>
		<td><a href="{{ action('PostController@show', [$post->id]) }}">{{ $post->user->username }}</a></td>
		<td>
			@foreach($post->lookingfors as $lookingfor)
				<p>{{$lookingfor->name}}</p>
			@endforeach
		</td>
		<td>
			@if($post->user->rank)
				{{ $post->user->rank->name }}
			@endif
		</td>
		<td><a href="{{ action('PostController@edit', [$post->id]) }}">Edit</a></td>
	</tr>
	@endforeach
</table>
@endif
