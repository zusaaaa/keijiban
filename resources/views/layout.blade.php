<!DOCTYPE html>
<html>
  <head>
    <title>keijiban</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/common.css">
    <script src="/js/app.js"></script>
  </head>
  <body>
  <header>
    @include("header")
  </header>
  <div id="contents">
    @yield("content")
  </div>
  <div id="num_box">
    <div id="num_of_users">今月の会員登録者数:{{ $count_user }} </div>
    <div id="num_of_posts">今月の累計投稿数:{{ $count_post }}</div>
  </div>
  <footer>
    @include("footer")
  </footer>
  <input type="hidden" name="token" value="">
  </body>
</html>