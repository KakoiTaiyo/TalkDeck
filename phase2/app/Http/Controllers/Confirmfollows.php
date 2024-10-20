<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Confirmfollows extends Controller
{
    public function followings($id)
    {
        $user = User::findOrFail($id);
        $followings = $user->followings;

        return view('profile.followings', compact('user','followings'));
    }

    public function followers($id)
    {
        $user = User::findOrFail($id);
        $followers = $user->followers;

        return view('profile.followers', compact('user','followers'));
    }
}
