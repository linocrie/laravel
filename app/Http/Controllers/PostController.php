<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
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
        $posts = Post::with('postImage')->authorize()->get();
        return view('post.post')
            ->with('posts', $posts);
    }

    public function create(): View
    {
        $professions = Profession::get();
        return view('post.create')
            ->with('professions', $professions);
    }

    public function store(PostRequest $request)
    {
        $path = $request->file('avatar')->store('images');
        $post = Post::authorize()->create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $post->postImage()->create([
            'user_id' => auth()->user()->id,
            'img_original_name' => $request->file('avatar')->getClientOriginalName(),
            'path' => $path
        ]);
        $post->professions()->attach($request->professions);
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('post.edit')
            ->with('post', $post)
            ->with('professions', Profession::get());
    }

    public function edit(PostRequest $request, Post $post)
    {
        $path = $request->file('avatar')->store('images');
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $post->postImage()->updateOrCreate(
            ['post_id' => $request->id],
            [
                'img_original_name' => $request->file('avatar')->getClientOriginalName(),
                'path' => $path,
            ]);
        $post->professions()->sync($request->professions);

        return redirect()->route('posts.index');
    }

    public function delete(Post $post)
    {
        if ($post->postImage()->exists()) {
            Storage::delete($post->postImage()->path);
        }
        $post->postImage()->delete();
        $post->professions()->detach();
        $post->delete();

        return redirect()->route('posts.index');
    }

}
