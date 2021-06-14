<div id="header">
  <div id="logo">keijiban</div>
    <form action="logout_ok.php" method="GET">
      <div id="button_box">
        <div id="link"><a href="{{ route("posts.create") }}">新規投稿</a></div>
<<<<<<< HEAD
        <a id="link" href="{{ route("logout") }}">ログアウト</a>
=======
        <button type="submit" id="link" name="logout" value="ログアウト">ログアウト</button>
>>>>>>> main
      </div>
    </form>
    <div id="button_box">
      <div id="link"><a href="{{ route("register") }}">新規登録</a></div>
      <div id="link"><a href="{{ route("login") }}">ログイン</a></div>
    </div>
  </div>
</div>