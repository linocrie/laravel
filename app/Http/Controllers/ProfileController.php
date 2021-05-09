<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail;
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
        $user = Auth::user()->load('detail');
//        $user->professions()->sync([1]);

        return view('profile')
            ->with('user', $user)
            ->with('detail', $user->detail);
    }

    public function update(Request $request) {
        $user = Auth::user()->load('detail');
//        dd($user);exit;
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
