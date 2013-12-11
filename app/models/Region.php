<?php

class Region
extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'regions';

	public function users()
	{
		return $this->hasMany('User');
	}

	public function continent()
	{
		return $this->belongsTo('Continent');
	}

}