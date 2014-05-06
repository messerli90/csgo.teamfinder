<?php

class VoipSeeder
extends DatabaseSeeder
{
	public function run()
	{
		Voip::truncate();
		
		$voips = [
			[
				'id'	=>	'1',
				'name'	=>	'Mumble'
			],
			[
				'id'	=>	'2',
				'name'	=>	'Teamspeak 3'
			],
			[
				'id'	=>	'3',
				'name'	=>	'Ventrilo'
			],
			[
				'id'	=>	'4',
				'name'	=>	'Raidcall'
			],
			[
				'id'	=>	'5',
				'name'	=>	'Skype'
			]
		];

	foreach ($voips as $voip)
	{
		Voip::create($voip);
	}

	}
}