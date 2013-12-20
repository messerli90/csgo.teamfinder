<?php

class Rating
extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ratings';

	public function user()
	{
		return $this->belongsTo('User');
	}

}