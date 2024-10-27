<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'response_text',
    ];

    // リレーションの設定
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSavedItems()
{
    return History::with('user')->get(); // 保存したデータを全て取得し、ユーザー情報も取得
}

}
