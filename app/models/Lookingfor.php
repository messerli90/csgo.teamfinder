<?php

class Lookingfor
extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lookingfors';

	public function posts()
	{
		return $this->belongsToMany('Post');
	}

}