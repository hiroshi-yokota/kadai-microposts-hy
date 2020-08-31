<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function favorited()
    {
    return $this->belongsToMany(User::class, 'favorite', 'micropost_id','user_id');

    }
}