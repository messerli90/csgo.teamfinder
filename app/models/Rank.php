<?php

class Rank
extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ranks';

	public function users()
	{
		return $this->hasMany('User');
	}

}