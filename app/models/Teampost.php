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
    'teamname'      =>  'required',
    'teamwebsite'   =>  'url',
    'steamgroup'    =>  'url',
    'teamavatar'    =>  'url',
    'region'        =>  '',
    'info'          =>  'required',
    'lookingfors'   =>  'required|between:1,4',
    'playstyles'    =>  'required|between:1,3'
  );
  public static $errorMessages = array(
    'between'     =>  'You must choose between :min - :max choices for :attribute'
  );


  public function user()
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
  
  public function teampostcomments()
  {
    return $this->hasMany('Teampostcomment');
  }

  public function skill()
  {
    return $this->belongsTo('Skill');
  }
}