<?php

class Teampost
extends Eloquent
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'teamposts';

  /**
   * Set rules for Post Validation
   *
   * @var array
   */
  public static $teampostRules = array(
    'region'        =>  'required',
    'info'          =>  'required',
    'lookingfors'   =>  'required|between:1,4',
    'playstyles'    =>  'required|between:1,3',
    'website'       =>  'url',
    'steamgroup'    =>  'url'
  );
  public static $errorMessages = array(
    'between'     =>  'You must choose between :min - :max choices for :attribute'
  );


  public function owner()
  {
    return $this->belongsTo('User');
  }

  public function region()
  {
    return $this->belongsTo('Region');
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