<!DOCTYPE html>
<html>
  <head>
    <title>keijiban</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/commons.css">
    <link rel="stylesheet" href="./style/login.css">
  </head>
  <header>
    @include("header")
  </header>
  <body>
    <form action="./send_mail.php" method="POST"  value="" id="form" name="userInfo" onsubmit="return sousin_event()">

      <div id="title"><p>仮登録</p></div>
      <div id="description"><p>メールアドレスを入力してください。</p></div>
      <div id="box">
        メールアドレス：<input type="text" name="mail_address" value="" id="mail_address">
        <br>
      </div>
      <input type="submit" value="送信" name="submit_event" id="button">
    </form>
    <footer>
      @include("footer")
    </footer>
    <script type="text/javascript" src="/BOARD/Controller/js/checkInfo.js"></script>
  </body>
</html>