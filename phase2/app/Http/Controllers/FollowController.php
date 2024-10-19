<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function follow($id)
    {
        $userToFollow = User::findOrFail($id);

        // 自分がすでにフォローしているかチェック
        if (!auth()->user()->following()->where('followed_id', $id)->exists()) {
            auth()->user()->following()->attach($userToFollow->id);
        }

        return back()->with('success', 'ユーザーをフォローしました');
    }

    public function unfollow($id)
    {
        $userToUnfollow = User::findOrFail($id);

        // フォローしているかチェック
        if (auth()->user()->following()->where('followed_id', $id)->exists()) {
            auth()->user()->following()->detach($userToUnfollow->id);
        }

        return back()->with('success', 'ユーザーのフォローを解除しました');
    }
}
