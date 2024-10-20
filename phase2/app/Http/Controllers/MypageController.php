<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MypageController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $followers = $user->followers;  // フォロワーを取得（リレーションが定義されている場合）
        $followings = $user->followings;  // フォローしているユーザーを取得

        return view('mypage', compact('user', 'followers', 'followings'));
    }

}
