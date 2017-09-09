<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Profile;
use App\Comments;

class Comments extends Model
{
    protected $guarded = ['id'];

    public function profile(){
        return $this->belongsTo('App\Profile');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
