<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'user_id' => 'user1',
                'account_name' => 'ユーザー1',
                'email' => 'user1@example.com',
                'password' => bcrypt('password1'), // パスワードをハッシュ化
                'answer_content' => '好きなことはアニメと音楽を聴くことです。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 'user2',
                'account_name' => 'ユーザー2',
                'email' => 'user2@example.com',
                'password' => bcrypt('password2'),
                'answer_content' => '好きなことは音楽を聴くこととVtuberを見ることです。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 'user3',
                'account_name' => 'ユーザー3',
                'email' => 'user3@example.com',
                'password' => bcrypt('password3'),
                'answer_content' => '好きなことはVtuberを見ることとゲームをすることです。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}