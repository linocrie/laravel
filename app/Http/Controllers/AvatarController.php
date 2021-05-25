<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $path = $request->file('avatar')->store('avatars');

        if($user->avatar){
            Storage::delete($user->avatar->path);
        }

        Avatar::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'original_name' => $request->file('avatar')->getClientOriginalName(),
                'path'          =>  $path,
            ]
        );

        return back()
            ->with('success','Avatar successfully uploaded');
    }
}
