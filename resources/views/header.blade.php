<div id="header">
  <div id="logo">keijiban</div>
    <form action="logout_ok.php" method="GET">
      <div id="button_box">
        <div id="link"><a href="#">新規投稿</a></div>
        <button type="submit" id="link" name="logout" value="ログアウト">ログアウト</button>
      </div>
    </form>
    <div id="button_box">
      <div id="link"><a href="{{ route("register") }}">新規登録</a></div>
      <div id="link"><a href="#">ログイン</a></div>
    </div>
  </div>
</div>