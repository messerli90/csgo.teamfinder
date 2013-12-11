<?php

class Post
extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts';

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function playstyles()
	{
		return $this->belongsToMany('Playstyle');
	}

	public function lookingfors()
	{
		return $this->belongsToMany('Lookingfor');
	}

}