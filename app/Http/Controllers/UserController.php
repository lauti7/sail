<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;
use App\User;

class UserController extends Controller
{
    public function getProfile(){
        return view('profile', ['user' => Auth::user()]);
    }

    public function uploadPhoto(Request $request){
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $user = Auth::user();
            $filename = $user->generatePhotoId();
            Image::make($avatar)->resize(300, 300)->save(public_path('/storage/images/avatars/'.$filename));
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile', ['user' => Auth::user()]);
    }
}
