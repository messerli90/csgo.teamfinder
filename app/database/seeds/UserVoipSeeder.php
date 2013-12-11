<?php

class UserVoipSeeder
extends DatabaseSeeder
{
	public function run()
	{
		UserVoip::truncate();
		
		$uservoips = [
			[
				'user_id'	=>	'1',
				'voip_id'	=>	'1'
			],
			[
				'user_id'	=>	'1',
				'voip_id'	=>	'2'
			]
		];

	foreach ($uservoips as $uservoip)
	{
		UserVoip::create($uservoip);
	}

	}
}