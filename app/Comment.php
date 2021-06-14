<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //可変項目
    protected $fillable = ["body"];

    public function post()
    {
        return $this->belongsTo("App\Post");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
