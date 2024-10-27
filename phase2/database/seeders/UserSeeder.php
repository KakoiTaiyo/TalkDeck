<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $users = [
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
      ]
      ];
    
    foreach($users as $user){
      User::create([
        'user_id' => $user['user_id'],
        'account_name' => $user['account_name'],
        'email' => $user['email'],
        'password' => $user['password'],
        'answer_content' => $user['answer_content'],
        'created_at' => $user['created_at'],
        'updated_at' => $user['updated_at'],
      ]);
    }
  }
}