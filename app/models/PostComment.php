<?php

class PostComment
extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'postcomments';

	public function post()
	{
		return $this->belongsTo('Post');
	}

}