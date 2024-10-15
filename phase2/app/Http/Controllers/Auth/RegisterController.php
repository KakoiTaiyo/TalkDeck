<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register.index');
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:users,user_id|max:255',
            'account_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'answer_content' => 'required|max:255',  
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'user_id' => $request->user_id,
            'account_name' => $request->account_name,
            'email' => $request->email,
            'answer_content' => $request->answer_content,
            'password' => $request->password, // bcryptはモデル内で処理
        ]);

        return redirect('/')->with('success', 'User registered successfully!');
    }
}

