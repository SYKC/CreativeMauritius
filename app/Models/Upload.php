<?php

namespace creativemauritius\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    public function user()
    {
      return $this->belongsTo('creativemauritius\User');
    }
}
