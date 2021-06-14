<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Post;

class ArticleController extends Controller
{

    /** 
     * 記事一覧を表示する
     * 
     * @return view
     */

    public function showList() {
        $posts = Post::all();
        return view("article.list", compact("posts"));
    }


    /** 
     * 記事詳細を表示する
     * @param int $id
     * @return view
     */

    public function showDetail($id) {
        $article = Article::find($id);

        if(is_null($id)){
            \Session::flash("err_msg", "データがありません。");
            return redirect(route("toppage"));
        }

        return view("article.detail", ["article" => $article]);
    }
}
