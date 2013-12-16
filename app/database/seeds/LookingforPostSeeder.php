<?php

class LookingforPostSeeder
extends DatabaseSeeder
{
	public function run()
	{
		LookingforPost::truncate();
		
		$lookingforPosts = [
			[
				'lookingfor_id'	=>	'1',
				'post_id'		=>	'1'
			],
			[
				'lookingfor_id'	=>	'4',
				'post_id'		=>	'1'
			],
			[
				'lookingfor_id'	=>	'2',
				'post_id'		=>	'5'
			],
			[
				'lookingfor_id'	=>	'4',
				'post_id'		=>	'1'
			]
		];

	foreach ($lookingforPosts as $lookingforPost)
	{
		LookingforPost::create($lookingforPost);
	}

	}
}