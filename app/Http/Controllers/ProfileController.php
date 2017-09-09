<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;
use App\User;
use App\Profile;
use App\Comments;
class ProfileController extends Controller
{
    public function getProfile($slug){
        $user = User::where('slug','=',$slug)->first();
        $profile = Profile::where('user_id', '=', $user->id)->first();
        $c = Comments::where('profile_id', $profile->id)->with('user')->get();

        return view('profiles.profile', ['user' => $user, 'profile' => $profile, 'c' => $c]);
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
        $profile = Profile::where('user_id', '=', $user->id)->first();
        return redirect()->back()->with('response', 'Tu foto se actualizo');
    }

    public function editProfile(){

        return view('profiles.edit', ['userProfile' => Auth::user()->profile]);
    }

    public function uploadProfile(Request $request, $slug){
        if ($request->hasFile('cruise')) {
            $cruise = $request->file('cruise');
            $user = User::where('slug','=',$slug)->first();
            $profile = Profile::where('user_id', '=', $user->id)->first();
            $filename = $profile->generatePhotoId();
            Image::make($cruise)->resize(1024, 768)->save(public_path('storage/images/cruises/'.$filename));
            Auth::user()->profile()->update([
                'describirte' => $request->describirte,
                'disponibilidad' => $request->disponibilidad,
                'cruise' => $filename
            ]);
        }

        return redirect()->route('profile', ['slug' => Auth::user()->slug]);
    }

    public function getFinishProfile(){
        return view('auth.after', ['userProfile' => Auth::user()->profile]);
    }

    public function postFinishProfile(Request $request){
        Auth::user()->profile()->update([
            'describirte' => $request->describirte,
            'disponibilidad' => $request->disponibilidad
        ]);

        return redirect('/home');
    }
}
