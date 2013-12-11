<?php

class UsersSeeder
extends DatabaseSeeder
{
	public function run()
	{
		User::truncate();

		$users = [
			[
				'username'		=>		'kniFely',
				'password'		=>		Hash::make('password'),
				'email'			=>		'knifelych@gmail.com',
				'steam'			=>		'knifely',
				'esea'			=>		'http://esea.com/knifely',
				'leetway'		=>		'http://leetway.com/knifely',
				'altpug'		=>		'http://altpug.com/knifely',
				'bio'			=>		"I'm kniFely, the founder of CSGO Team Finder",
				'region_id'		=>		6,
				'skill_id'		=>		2,
				'rank_id'		=>		13
			]
		];

		foreach ($users as $user)
		{
			User::create($user);
		}
	}
}