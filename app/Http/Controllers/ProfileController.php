<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile')
            ->with('user', Auth::user());
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:191',
            'email'    => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id())
            ],
            'password' => 'nullable|string'
        ]);

        // 1. Select by find
        $user = User::find(Auth::id());
        $details = Details::find(Auth::id());
        // Update
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password
        ]);
        $details->update([
            'phone'   => $request->phone,
            'address' => $request->address,
            'city'    => $request->city,
            'country' => $request->country
        ]);

        return back()->with('success', 'Profile has been updated successfully!');
    }
}
