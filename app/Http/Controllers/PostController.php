<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
//        dd(auth()->user()->load('post')->post);

        $user = Auth::user()->load(['post'])->post->all();
//        dd($user->post);

        foreach ($user as $value){
//            dd($value->path);
            if(!$value->path){
                $post_path = 'avatars/avatar.png';
            }
            else{
                $post_path = $value->path;
            }
        }
        return view('post')
            ->with('user',$user)
            ->with('post_path',$post_path);
    }

    public function store(Request $request)
    {
//        dd($request->description);
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:191',
            'description' => 'required'
       ]);

        $path = $request->file('avatar')->store('avatars');

        Post::create(
            [
                'user_id'              =>  Auth::id(),
                'title'                =>  $request->title,
                'description'          =>  $request->description,
                'img_original_name'    =>  $request->file('avatar')->getClientOriginalName(),
                'path'                 =>  $path,
            ]
        );

        return redirect()->route('posts.index');
    }
}
