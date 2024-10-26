<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    public function histories()
    {
    return $this->hasMany(History::class);
    }

}
