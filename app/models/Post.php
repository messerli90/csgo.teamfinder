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

	/**
	 * Set rules for Post Validation
	 *
	 * @var array
	 */
	public static $postRules = array(
		'goal'				=>	'required',
		'contact'			=>	'required',
		'lookingfors'		=>	'required|between:1,4',
		'playstyles'		=>	'required|between:1,3'
	);
	public static $errorMessages = array(
		'between'			=> 	'You must choose between :min - :max choices for :attribute'
	);


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
	public function postcomments()
	{
		return $this->hasMany('PostComment');
	}
}