<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * 登録の後にユーザーをどの画面にリダイレクトさせるか
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function pre_check(Request $request) {
        $this->validator($request->all())->validate();
        //メールアドレスのみflashデータとしてセッションに保存
        $request->flashOnly("email");

        $bridge_request = $request->all();
        //password マスキング
        $bridge_request["password_mask"] = "******";

        return view("auth.register_check")->with($bridge_request);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /*
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        */
        $user = User::create([
            "user_id" => $data["userId"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            "email_verify_token" => base64_encode($data["email"])
        ]);

        $email = new EmailVerification($user);
        Mail::to($user->email)->send($email);

        return $user;
    }

    public function register(Request $request)
    {
        event(new Registered($user = $this->create($request->all() )));

        return view("auth.registered");
    }

    public function showForm($email_token)
    {
        //使用可能なトークンか
        if ( !User::where("email_verify_token", $email_token)->exists() ) 
        {
            return view("auth.main.registered")->with("message", "無効なトークンです。");
        } else {
            $user = User::where("email_verify_token", $email_token)->first();
            //本登録済のユーザーか
            if ($user->status == config("const.USER_STATUS_REGISTER")) // REGISTER=1
            {
                logger("status". $user->status );
                return view("auth.main.registered")->with("message", "すでに本登録されています。ログインして利用してください。");
            }
            //ユーザーステータス更新
            $user->status = config("const.USER_STATUS.MAIL_AUTHED");
            $user->verify_at =Carbon::now();
            if($user->save()) {
                return view("auth.main.registered", compact("email_token"));
            } else {
                return view("auth.main.registered")->with("message", "メール認証に失敗しました。再度メールからクリックしてください。");
            }
        }
    }
}
