<?php

namespace creativemauritius\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $table = 'Projects';

  protected $fillable = [
      'id', 'title', 'body', 'featured_image', 'tags', 'permission', 'user_id',
  ];

  public function user()
  {
    return $this->belongsTo('creativemauritius\Models\Project');
  }
}
