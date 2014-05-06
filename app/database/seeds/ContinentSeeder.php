<?php

class ContinentSeeder
extends DatabaseSeeder
{
	public function run()
	{
		Continent::truncate();
		$continents = [
			[
				'id'	=>	'1',
				'name'	=>	'North America'
			],
			[
				'id'	=>	'2',
				'name'	=>	'South America'
			],
			[
				'id'	=>	'3',
				'name'	=>	'Europe'
			],
			[
				'id'	=>	'4',
				'name'	=>	'Asia'
			],
			[
				'id'	=>	'5',
				'name'	=>	'Australia'
			]
		];

	foreach ($continents as $continent)
	{
		Continent::create($continent);
	}

	}
}
