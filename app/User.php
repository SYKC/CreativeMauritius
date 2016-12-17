<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'username', 'avatar', 'biography', 'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getUsername()
    {
      return $this->username;
    }

    public function getName()
    {
      if ($this->name)
      {
        return $this->name;
      }
        return "none";
    }

    public function scopegetId($query)
    {
      return $query->id;
    }

    public function uploads()
    {
      return $this->hasMany('App\Upload');
    }
}
