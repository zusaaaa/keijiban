<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //可変項目の設定
    protected $fillable = ["title", "body"];

    //リレーション
    public function comments()
    {
        return $this->hasMany("App\Comment");
    }
    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
