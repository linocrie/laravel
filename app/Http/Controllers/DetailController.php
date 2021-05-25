<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail;
use App\Models\Profession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request) {
        $user = Auth::user();
        Detail::updateOrCreate(
            ['user_id'    => $user->id],
            [
                'phone'   => $request->phone,
                'address' => $request->address,
                'city'    => $request->city,
                'country' => $request->country
            ]
        );
        $requested = $request->professions;
        $user->professions()->sync($requested);
        return back()
            ->with('success', 'Detail successfully updated');
    }
}

