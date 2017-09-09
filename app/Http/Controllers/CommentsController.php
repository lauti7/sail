<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentsRequest;
use App\Comments;
use App\Profile;
use App\User;
use Auth;
use Session;

class CommentsController extends Controller
{
    public function newComment(CommentsRequest $r, $profile_id){

        $profile = Profile::find($profile_id);

        $comment = new Comments;

        $comment->comment = $r->content;
        $comment->user_id = Auth::user()->id;
        $comment->profile()->associate($profile);

        $comment->save();

        Session::flash('success', 'El comentario fue enviado correctamente');
        return redirect()->back()->with('response', 'El comentario ha sido creo');
    }
}
