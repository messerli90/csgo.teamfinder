<?php

class TeampostSeeder
extends DatabaseSeeder
{
  public function run()
  {
    Teampost::truncate();
    
    $teamposts = [

      [
        'id'        =>  '1',
        'name'      =>  'Absolute Gaming',
        'user_id'  =>  '76561197982623132',
        'region_id' => '6',
        'skill_id'  => '4',
        'website'   => 'http://csgoteamfinder.com',
        'steamgroup'=> 'http://steamcommunity.com/absolutegaming',
        'info'      => 'super gaming clan'
      ]
    ];

  foreach ($teamposts as $teampost)
  {
    Teampost::create($teampost);
  }

  }
}