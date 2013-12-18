<?php

class RankSeeder
extends DatabaseSeeder
{
	public function run()
	{
		Rank::truncate();
		
		$ranks = [
			[
				'id'	=>	'19',
				'name'	=>	'No Rank'
			],
			[
				'id'	=>	'1',
				'name'	=>	'Silver I',
				'img'	=>	'img/ranks/elo1.png'
			],
			[
				'id'	=>	'2',
				'name'	=>	'Silver II',
				'img'	=>	'img/ranks/elo2.png'
			],
			[
				'id'	=>	'3',
				'name'	=>	'Silver III',
				'img'	=>	'img/ranks/elo3.png'
			],
			[
				'id'	=>	'4',
				'name'	=>	'Silver IV',
				'img'	=>	'img/ranks/elo4.png'
			],
			[
				'id'	=>	'5',
				'name'	=>	'Silver Elite',
				'img'	=>	'img/ranks/elo5.png'
			],
			[
				'id'	=>	'6',
				'name'	=>	'Silver Elite Master',
				'img'	=>	'img/ranks/elo6.png'
			],
			[
				'id'	=>	'7',
				'name'	=>	'Gold Nova I',
				'img'	=>	'img/ranks/elo7.png'
			],
			[
				'id'	=>	'8',
				'name'	=>	'Gold Nova II',
				'img'	=>	'img/ranks/elo8png'
			],
			[
				'id'	=>	'9',
				'name'	=>	'Gold Nova III',
				'img'	=>	'img/ranks/elo9.png'
			],
			[
				'id'	=>	'10',
				'name'	=>	'Gold Nova Master',
				'img'	=>	'img/ranks/elo10.png'
			],
			[
				'id'	=>	'11',
				'name'	=>	'Master Guardian I',
				'img'	=>	'img/ranks/elo11.png'
			],
			[
				'id'	=>	'12',
				'name'	=>	'Master Guardian II',
				'img'	=>	'img/ranks/elo12.png'
			],
			[
				'id'	=>	'13',
				'name'	=>	'Master Guardian Elite',
				'img'	=>	'img/ranks/elo13.png'
			],
			[
				'id'	=>	'14',
				'name'	=>	'Distinguished Master Guardian',
				'img'	=>	'img/ranks/elo14.png'
			],
			[
				'id'	=>	'15',
				'name'	=>	'Legendary Eagle',
				'img'	=>	'img/ranks/elo15.png'
			],
			[
				'id'	=>	'16',
				'name'	=>	'Legendary Eagle Master',
				'img'	=>	'img/ranks/elo16.png'
			],
			[
				'id'	=>	'17',
				'name'	=>	'Supreme Master First Class',
				'img'	=>	'img/ranks/elo17.png'
			],
			[
				'id'	=>	'18',
				'name'	=>	'The Global Elite',
				'img'	=>	'img/ranks/elo18.png'
			]
		];

	foreach ($ranks as $rank)
	{
		Rank::create($rank);
	}

	}
}