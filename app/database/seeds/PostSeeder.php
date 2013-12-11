<?php

class PostSeeder
extends DatabaseSeeder
{
	public function run()
	{
		Post::truncate();
		
		$posts = [
			[
				'user_id'	=>	'1',
				'goal'		=>	'Looking for a team that will join a league.',
				'contact'	=>	'Best if reached by Steam message'
			],
			[
				'user_id'	=>	'1',
				'goal'		=>	'Just some friendly people to play with.',
				'contact'	=>	'Call me on Skype: someuser'
			]
		];

	foreach ($posts as $post)
	{
		Post::create($post);
	}

	}
}