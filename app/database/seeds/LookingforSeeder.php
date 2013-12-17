<?php

class LookingforSeeder
extends DatabaseSeeder
{
	public function run()
	{
		Lookingfor::truncate();
		
		$lookingfors = [
			[
				'id'	=>	'1',
				'name'	=>	'Competitive / League'
			],
			[
				'id'	=>	'2',
				'name'	=>	'Valve MatchMaking'
			],
			[
				'id'	=>	'3',
				'name'	=>	'Mixes / Gathers'
			],
			[
				'id'	=>	'4',
				'name'	=>	'Casual / Friends'
			],
			[
				'id'	=>	'5',
				'name'	=>	'5v5'
			],
			[
				'id'	=>	'6',
				'name'	=>	'3v3'
			],
			[
				'id'	=> '7',
				'name'	=>	'2v2'
			]
		];

	foreach ($lookingfors as $lookingfor)
	{
		Lookingfor::create($lookingfor);
	}

	}
}