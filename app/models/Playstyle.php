<?php

class Playstyle
extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'playstyles';

	public function posts()
	{
		return $this->belongsToMany('Post');
	}

}