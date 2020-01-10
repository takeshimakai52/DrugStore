<?php
session_start();
if(isset($_SESSION['err_msg'])){
  $err_msg = $_SESSION['err_msg'];
}else{
  $err_msg = null;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="ectest.css">
  <script src="login.js"></script>
  <title>マスターメンテナンスログイン</title>
</head>
<body>
  <header>
    <h1>Drag Takayama</h1>
    <a href="" class="frontlink">フロントエンド</a>
  </header>
  <div class="login">
    <p>DragStoreマスターメンテナンス</p>
    <form name="myform" action="logincheck.php" method="POST" >
      <div class="error" id="errorMessage"><?= $err_msg ?></div>
      <p>
        ログインID
        <input type="text" name="account" id="account" value="">
      </p>
      <p>
        パスワード
        <input type="password" name="password" id="password" value="">
      </p>
      <input type="button" name="login" value="ログイン" class="loginbutton" onclick="myfunc();">
    </form>
  </div>
</body>
</html>
