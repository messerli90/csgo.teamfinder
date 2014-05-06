<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('ContinentSeeder');
		$this->call('RegionSeeder');
		$this->call('SkillSeeder');
		$this->call('RankSeeder');
		$this->call('VoipSeeder');
		//$this->call('UserVoipSeeder');
		$this->call('PlaystyleSeeder');
		//$this->call('PlaystylePostSeeder');
		$this->call('LookingforSeeder');
		//$this->call('LookingforPostSeeder');
		//$this->call('PostSeeder');
		//$this->call('UsersSeeder');
		$this->call('StatusSeeder');
		$this->call('TeampostSeeder');
	}

}