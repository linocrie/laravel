<?php

namespace App\Http\Controllers;

use App\Models\Galleries;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail;
use App\Models\Avatar;
use App\Models\Profession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user()->load(['detail','avatar','professions']);
        if(!$user->avatar){
            $user_path = 'avatars/avatar.png';
        }
        else{
            $user_path = $user->avatar->path;
        }
        $professions = Profession::get();
        $gallery =  Galleries::where('user_id', Auth::id())->get();
        return view('profile')
            ->with('user', $user)
            ->with('professions',$professions)
            ->with('user_path',$user_path)
            ->with('gallery',$gallery);
    }
    public function update(Request $request)
    {
        $user = Auth::user()->load('detail');
        User::updateOrCreate(
            ['id' => $user->id],
            [
                'name' => $request->name,
                'email' => $request->email,
            ]
        );
        return back()
            ->with('success', 'Profile successfully updated');
    }
}
