<?php

class RegionSeeder
extends DatabaseSeeder
{
	public function run()
	{
		Region::truncate();

		$regions = [
			[
				'id'			=>	'1',
				'name'			=>	'North America / West',
				'continent_id'	=>	'1'
			],
			[
				'id'			=>	'2',
				'name'			=>	'North America / Central',
				'continent_id'	=>	'1'
			],
			[
				'id'			=>	'3',
				'name'			=>	'North America / East',
				'continent_id'	=>	'1'
			],
			[
				'id'			=>	'4',
				'name'			=>	'South America',
				'continent_id'	=>	'2'
			],
			[
				'id'			=>	'5',
				'name'			=>	'Europe / East',
				'continent_id'	=>	'3'
			],
			[
				'id'			=>	'6',
				'name'			=>	'Europe / Central',
				'continent_id'	=>	'3'
			],
			[
				'id'			=>	'7',
				'name'			=>	'Europe / North',
				'continent_id'	=>	'3'
			],
			[
				'id'			=>	'8',
				'name'			=>	'Europe / West',
				'continent_id'	=>	'3'
			],
			[
				'id'			=>	'9',
				'name'			=>	'Asia',
				'continent_id'	=>	'4'
			],
			[
				'id'			=>	'10',
				'name'			=>	'Australia',
				'continent_id'	=>	'5'
			]

		];

		foreach ($regions as $region)
		{
			Region::create($region);
		}


	}

}