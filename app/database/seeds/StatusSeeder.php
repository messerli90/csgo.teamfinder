<?php

class StatusSeeder
extends DatabaseSeeder
{
	public function run()
	{
		Status::truncate();
		
		$statuses = [

			[
				'id'	=>	'1',
				'name'	=>	'Searching',
				'img'	=>	''
			],
			[
				'id'	=>	'2',
				'name'	=>	'Recruiting',
				'img'	=>	''
			],
			[
				'id'	=>	'3',
				'name'	=>	'Available right now!',
				'img'	=>	''
			],
			[
				'id'	=>	'4',
				'name'	=>	'Not searching',
				'img'	=>	''
			],
			[
				'id'	=>	'5',
				'name'	=>	'No Status',
				'img'	=>	''
			]
		];

	foreach ($statuses as $status)
	{
		Status::create($status);
	}

	}
}