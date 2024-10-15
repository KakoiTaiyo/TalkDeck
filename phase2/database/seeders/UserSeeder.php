<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // ユーザー1
        User::create([
            'user_id' => 'user1',
            'account_name' => 'ユーザー1',
            'email' => 'user1@example.com',
            'password' => 'password1', // パスワードはここで平文で指定
            'answer_content' => '好きなことはアニメと音楽を聴くことです。',
        ]);

        // ユーザー2
        User::create([
            'user_id' => 'user2',
            'account_name' => 'ユーザー2',
            'email' => 'user2@example.com',
            'password' => 'password2',
            'answer_content' => '好きなことは音楽を聴くこととVtuberを見ることです。',
        ]);

        // ユーザー3
        User::create([
            'user_id' => 'user3',
            'account_name' => 'ユーザー3',
            'email' => 'user3@example.com',
            'password' => 'password3',
            'answer_content' => '好きなことはVtuberを見ることとゲームをすることです。',
        ]);
    }
}
