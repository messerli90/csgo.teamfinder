<?php

class PlaystylePostSeeder
extends DatabaseSeeder
{
	public function run()
	{
		PlaystylePost::truncate();
		
		$playstylePosts = [
			[
				'playstyle_id'	=>	'1',
				'post_id'		=>	'1'
			],
			[
				'playstyle_id'	=>	'4',
				'post_id'		=>	'1'
			]
		];

	foreach ($playstylePosts as $playstylePost)
	{
		PlaystylePost::create($playstylePost);
	}

	}
}