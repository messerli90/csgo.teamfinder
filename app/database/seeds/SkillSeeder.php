<?php

class SkillSeeder
extends DatabaseSeeder
{
	public function run()
	{
		Skill::truncate();
		
		$skills = [
			[
				'id'	=>	'1',
				'name'	=>	'Low'
			],
			[
				'id'	=>	'2',
				'name'	=>	'Low/Mid'
			],
			[
				'id'	=>	'3',
				'name'	=>	'Mid'
			],
			[
				'id'	=>	'4',
				'name'	=>	'Mid/High'
			],
			[
				'id'	=>	'5',
				'name'	=>	'High'
			]
		];

	foreach ($skills as $skill)
	{
		Skill::create($skill);
	}

	}
}