<?php
//メール処理に必要なものを記述

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    //クラス変数の追加
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //引数で受け取ったデータを変数へセットする
        $this->user = $user;
    }

    /**
     * 
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("仮登録が完了しました") // 件名
            ->view('auth.email.pre_register') //メール本文のテンプレートとなるview
            ->with(["token" => $this->user->email_verify_token,]); // 必要なデータ(今回はURLの後につけるトークンデータ)
    }
}