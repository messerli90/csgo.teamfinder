<?php

class PlaystyleSeeder
extends DatabaseSeeder
{
	public function run()
	{
		Playstyle::truncate();
		
		$playstyles = [
			[
				'id'	=>	'1',
				'name'	=>	'AWP'
			],
			[
				'id'	=>	'2',
				'name'	=>	'Entry Fragger'
			],
			[
				'id'	=>	'3',
				'name'	=>	'Support'
			],
			[
				'id'	=>	'4',
				'name'	=>	'Flanker/ Lurker'
			],
			[
				'id'	=>	'5',
				'name'	=>	'Caller / IGL'
			],
			[
				'id'	=>	'6',
				'name'	=>	'Rifler'
			]
		];

	foreach ($playstyles as $playstyle)
	{
		Playstyle::create($playstyle);
	}

	}
}