<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // このモデルに関連するテーブル名
    protected $table = 'users';

    // 自動的にタイムスタンプを管理する
    public $timestamps = true;

    // ホワイトリスト化する属性
    protected $fillable = [
        'user_id',
        'account_name',
        'email',
        'password',
        'answer_content',
    ];

    // パスワードをハッシュ化するためのアクセサ
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
