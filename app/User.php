<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function generatePhotoId(){
      $md5 = md5("$this->id $this->update_at");
      $md5JPG = $md5 . '.jpg';
      return $md5JPG;
    }

    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public function comments(){
        $this->hasMany('App\Comments', 'user_id');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','location','slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
