<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	
	/**
	 * Set rules for Registration Validation
	 *
	 * @var array
	 */
	public static $registrationRules = array(
		'username'							=>'required|alpha_num|min:5|unique:users',
		'email'									=>'required|email|unique:users',
		'password'							=>'required|between:6,32|confirmed',
		'password_confirmation'	=>'required',
		);
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
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

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
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
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
	
	public function status()
	{
		return $this->belongsTo('Status');
	}

	public function voips()
	{
		return $this->belongsToMany('Voip');
	}

	public function posts()
	{
		return $this->hasMany('Post');
	}

	public function teamposts()
	{
		return $this->hasMany('Teampost');
	}

	public function ratings()
	{
		return $this->hasMany('Rating');
	}

	public function shortlists()
	{
		return $this->hasMany('Shortlist');
	}
}
