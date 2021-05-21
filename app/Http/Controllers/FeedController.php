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
      @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $professions = auth()->user()->load(['professions'])->professions;
        $posts = Post::whereHas('professions', function (Builder $query) use ($professions){
            $arr = [];

            foreach($professions as $value) {
                array_push($arr,$value->id);
            }
            $query->whereIn('id', $arr);

        })->simplePaginate(5);

        return view('feed')
            ->with('posts',$posts);
    }

    public function view(Post $post)
    {
        $user = Post::where('id',$post->id)->first()->load(['postImage']);

        if(!$user->postImage->avatar){
            $user_path = 'avatars/avatar.png';
        }
        else{
            $user_path = $user->postImage->path;
        }

        return view('postMore')
            ->with('user',$user)
            ->with('user_path',$user_path)
            ->with('post_user',$post->user()->first())
            ->with('profession', Profession::get());
    }

}
