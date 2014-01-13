<?php

class Voip
extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'voips';

	public function users()
	{
		return $this->belongsToMany('User');
	}

	public function steamusers()
	{
		return $this->belongsToMany('Steamuser');
	}

}