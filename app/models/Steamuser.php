<?php


class Steamuser extends Eloquent {
	
	/**
	 * Set rules for Edit Validation
	 *
	 * @var array
	 */
	public static $editRules = array(
		'avatar'				=>'image|max:2000',
		'steam'					=>'url',
		'esea'					=>'url',
		'altpug'				=>'url',
		'leetway'				=>'url'
		);
	/**
	 * Set rules for Edit Validation
	 *
	 * @var array
	 */
	public static $reviewRules = array(
		'score'					=>'required',
		'review'				=>'required'
		);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'steamusers';

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}


	/**
	 * Set Relationships
	 *
	 *
	 */
	public function region()
	{
		return $this->belongsTo('Region');
	}

	public function skill()
	{
		return $this->belongsTo('Skill');
	}

	public function rank()
	{
		return $this->belongsTo('Rank');
	}

	public function voips()
	{
		return $this->belongsToMany('Voip');
	}

	public function posts()
	{
		return $this->hasMany('Post');
	}

	public function ratings()
	{
		return $this->hasMany('Rating');
	}
}
