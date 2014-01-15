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
				'name'	=>	'AWP',
				'img'	=>	'/img/roles/awp-icon.png'
			],
			[
				'id'	=>	'2',
				'name'	=>	'Entry Fragger',
				'img'	=>	'/img/roles/entryfragger-icon.png'
			],
			[
				'id'	=>	'3',
				'name'	=>	'Support',
				'img'	=>	'/img/roles/support-icon.png'
			],
			[
				'id'	=>	'4',
<<<<<<< HEAD
				'name'	=>	'Flanker/ Lurker',
=======
				'name'	=>	'Flanker / Lurker',
>>>>>>> cleanup
				'img'	=>	'/img/roles/flanker-icon.png'
			],
			[
				'id'	=>	'5',
				'name'	=>	'Caller / IGL',
				'img'	=>	'/img/roles/caller-icon.png'
			],
			[
				'id'	=>	'6',
				'name'	=>	'Rifler',
				'img'	=>	'/img/roles/rifler-icon.png'
			]
		];

	foreach ($playstyles as $playstyle)
	{
		Playstyle::create($playstyle);
	}

	}
}