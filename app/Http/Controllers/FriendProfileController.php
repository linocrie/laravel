<?php

namespace App\Http\Controllers;

use App\Models\Galleries;
use App\Models\Post;
use App\Models\Profession;
use App\Models\GalleriesImages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendProfileController extends Controller
{

    public function show(User $profile)
    {
        $friend = $profile->load(['avatar','detail','professions','gallery']);
        if(!$friend->avatar){
            $path = 'avatars/avatar.png';
        }
        else{
            $path = $friend->avatar->path;
        }
        $professions = Profession::get();
        return view('post.friend')
            ->with('friend', $friend)
            ->with('path', $path)
            ->with('professions', $professions);
    }
}
