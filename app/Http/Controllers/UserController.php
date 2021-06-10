<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * ユーザーの新規登録画面表示
     * 
     * @return view
     */

     public function getSignup() {
         return view("signup");
     }

     /**
     * ユーザーの新規登録(DB)
     * 
     * @return view
     */

    //テーブル名
    protected $table = "users";

    //可変項目(ホワイトリスト登録)
    protected $fillable = [
        "user_id",
        "email",
        "password"
    ];

    //データ登録する
    public function postSignup($request) {
        $post = new User;
        $post->user_id = $request->user_id;
        $post->email = $request->email;
        $post->password = $request->password;

        $post->save();
    }
}
