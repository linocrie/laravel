<?php

namespace App\Http\Controllers;

use App\Models\Galleries;
use App\Models\Post;
use App\Models\Profession;
use App\Models\GalleriesImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendProfileController extends Controller
{
    public function show(Post $post)
    {
        $user = Auth::user()->load(['detail', 'avatar', 'professions','gallery']);
        $gallery = Galleries::where('user_id',$post->user_id)->get();

        if(!$user->avatar){
            $user_path = 'avatars/avatar.png';
        }
        else{
            $user_path = $user->avatar->path;
        }

        $professions = Profession::get();

        return view('postUser')
            ->with('user_post', $post->user()->first())
            ->with('user', $user)
            ->with('user_path', $user_path)
            ->with('gallery', $gallery)
            ->with('professions', $professions);
    }
}
