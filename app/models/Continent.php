<?php

class Continent
extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'continents';

	public function region()
	{
		return $this->hasMany('Regions');
	}

}