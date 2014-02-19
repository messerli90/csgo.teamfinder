<?php

class TeampostComment
extends Eloquent
{
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'teampostcomments';

  public function teampost()
  {
    return $this->belongsTo('Teampost');
  }

}