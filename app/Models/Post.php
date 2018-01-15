<?php

namespace creativemauritius\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $table = 'posts';

  protected $fillable = [
      'id', 'title', 'body', 'featured_image', 'tags', 'user_id', 'excerpt_body',
  ];

    public function user()
    {
      return $this->belongsTo('creativemauritius\Models\User');
    }
}
