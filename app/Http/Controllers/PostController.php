<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\User;
use App\Post; //Postモデルを使用する宣言
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * 投稿一覧の表示
     *
     * @return view
     */
    public function index()
    {
        //当月会員取得
        $month = new Carbon();
        $month = Carbon::now()->format("Y-m");
        $count_user = User::where("created_at", "like", "%$month%")->count();

        //当月投稿数取得
        $count_post = Post::where("created_at", "like", "%$month%")->count();

        $posts = Post::all();
        $posts->load("user");
        return view("posts.index", compact("posts", "count_user", "count_post"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create(新規投稿)画面を表示する
        return view(("posts.create"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post; //インスタンスを作成

        $post -> title = $request -> title; //入力したtitle($request)を代入
        $post -> body  = $request -> body; //入力したbodyを代入
        $post -> user_id = Auth::id(); //ログイン中のuser_idを代入

        $post -> save();

        return redirect() ->route("posts.index");
    }

    /**
     * 詳細画面の表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id); //Postモデル内で、クリックしたものと一致するidのものを取得
        $post->load("user", "comments"); //Eagerロード
        return view("posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id); //Postモデル内でクリックした記事を探す

        if(Auth::id() !== $post->user_id) {
            return abort(404);
        }

        return view("posts.edit", compact("post"));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::find($id);

        if(Auth::id() !== $post->user_id) {
            return abort(404);
        }

        $post -> title = $request -> title;
        $post -> body  = $request -> body;

        $post -> save();

        return view("posts.show", compact("post"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);

        if(Auth::id() !== $post->user_id) {
            return abort(404);
        }

        $post -> delete();

        return redirect() -> route("posts.index");
    }
}
