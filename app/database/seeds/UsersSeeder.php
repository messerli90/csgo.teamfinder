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
				'birthday'		=>		'1990-10-31',
				'steam'			=>		'knifely',
				'esea'			=>		'http://esea.com/knifely',
				'leetway'		=>		'http://leetway.com/knifely',
				'altpug'		=>		'http://altpug.com/knifely',
				'bio'			=>		"I'm kniFely, the founder of CSGO Team Finder",
				'region_id'		=>		6,
				'skill_id'		=>		2,
				'rank_id'		=>		13
			],
			[
				'username'		=>		'bingO',
				'password'		=>		Hash::make('password'),
				'email'			=>		'bingo@gmail.com',
				'birthday'		=>		'1994-6-12',
				'steam'			=>		'bingo',
				'esea'			=>		'http://esea.com/bingo',
				'leetway'		=>		'http://leetway.com/bingo',
				'altpug'		=>		'http://altpug.com/bingo',
				'bio'			=>		"I'm bingo, the designer of CSGO Team Finder",
				'region_id'		=>		7,
				'skill_id'		=>		2,
				'rank_id'		=>		12
			]
		];

		foreach ($users as $user)
		{
			User::create($user);
		}
	}
}