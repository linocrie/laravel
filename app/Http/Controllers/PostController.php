<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index()
    {
        $user = Post::where('user_id',Auth::id())->get()->load(['postImage']);
        return view('post')
            ->with('user',$user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'required'
       ]);
        $path = $request->file('avatar')->store('images');
        $post = Post::create(
            [
                'user_id'     =>  auth()->user()->id,
                'title'       =>  $request->title,
                'description' =>  $request->description,
            ]
        );
        PostImage::Create(
            [
                'post_id'           => $post->id,
                'user_id'           => auth()->user()->id,
                'img_original_name' => $request->file('avatar')->getClientOriginalName(),
                'path'              => $path
            ]
        );
        $post->professions()->attach($request->professions);
        return redirect()->route('posts.index');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $path = $request->file('avatar')->store('images');
        Post::updateOrCReate(
            [
                'id' => $request->id,
            ],
            [
                'title'        =>  $request->title,
                'description'  =>  $request->description,
            ]
        );
        $post_id = $request->id;
        PostImage::updateOrCreate(
            [
                'post_id' => $post_id,
            ],
            [
                'img_original_name' => $request->file('avatar')->getClientOriginalName(),
                'path'              =>  $path,
            ]
        );
        Post::where('id', $request->id)->where('user_id',Auth::id())->first()->professions()->sync($request->professions);
        return redirect()->route('posts.index');
    }

    public function delete(Request $request) {
        if(Post::where('id', $request->id)->first()->load(['postImage'])->postImage){
            Storage::delete(Post::where('id',$request->id)->first()->load(['postImage'])->postImage->path);
        }

        PostImage::where('post_id',$request->id)->delete();
        Post::where('id',$request->id)->first()->professions()->detach($request->professions);
        Post::where('id',$request->id)->delete();

        return redirect()->route('posts.index');
    }

    public function show(Post $id): View
    {
        return view('postEdit')
            ->with('post',$id)
            ->with('professions', Profession::get());
    }
    public function create(): View
    {
        $professions = Profession::get();
        return view('postCreate')
            ->with('professions',$professions);
    }

}
