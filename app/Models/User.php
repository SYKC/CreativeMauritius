<?php

namespace creativemauritius\Models;

use Illuminate\Database\Eloquent\Model;
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
        'name', 'email', 'password', 'username', 'avatar', 'biography', 'location', 'user_role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
      return $this->hasMany('creativemauritius\Models\Post');
    }

    public static function getAllUsers() {
      return User::count();
    }

    public static function getRoutes()
    {
      $count = 0;
      $routeCollection = Route::getRoutes();
      foreach ($routeCollection as $value) {
        $count = $count + 1;
      }
      echo $count;
    }

    public function getUsername($id)
    {
      return $this->username;
    }

    public static function lolsec()
    {
      return "Hello!";
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
      return $this->hasMany('creativemauritius\Upload');
    }
}
