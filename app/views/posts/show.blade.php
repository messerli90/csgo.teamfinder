<h1>Post</h1>

<p>{{ $post->user->username }}</p>

<p>Looking for:</p>
<ul>
	@foreach($post->lookingfors as $lookingfor)
	<li>{{ $lookingfor->name }}</li>
	@endforeach
</ul>