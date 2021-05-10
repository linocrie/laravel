<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail;
use App\Models\Profession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $professions = Profession::get()->toArray();
        $user = Auth::user()->load('detail');
//        $selected_professions = User::with(['professions'])->find(Auth::id())->toArray()['professions'];

        return view('profile')
            ->with('user', $user)
            ->with('detail', $user->detail)
            ->with('professions',$professions);
//            ->with('selected_professions',$selected_professions);
    }

    public function update(Request $request) {
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
