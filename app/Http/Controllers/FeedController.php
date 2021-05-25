<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class FeedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $professions = auth()->user()->professions;

        $posts = Post::whereHas('professions', function (Builder $query) use ($professions){
            $query->whereIn('profession_id', $professions->pluck('id')->all());
        })
            ->where('user_id', '!=', auth()->id())
            ->paginate(5);

        return view('feed')->with('posts', $posts);
    }

    public function view(Post $post)
    {
        $posts = Post::with(['postImage', 'professions'])->where('id', $post->id)->first();
        if (!$posts->postImage->avatar) {
            $path = 'avatars/avatar.png';
        } else {
            $path = $posts->postImage->path;
        }
        return view('post.more')
            ->with('posts', $posts)
            ->with('path', $path)
            ->with('post_user', $post->user()->first());
    }
}
