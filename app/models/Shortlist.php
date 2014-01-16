<?php

class Shortlist
extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'shortlists';

	public function user()
	{
		return $this->belongsTo('User');
	}

}