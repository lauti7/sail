<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Profile;
use App\Comments;

class Profile extends Model
{
    protected $fillable = ['describirte', 'disponibilidad', 'user_id', 'cruise'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comments(){
        return $this->hasMany('App\Comments', 'profile_id');
    }
    public function generatePhotoId(){
        $md5 = md5("$this->id $this->update_at");
        $md5JPG = $md5 . '.jpg';
        return $md5JPG;
    }


}
