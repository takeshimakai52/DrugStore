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
  <title>マスターメンテナンスログイン</title>
</head>
<body>
  <header>
    <h1>Drag Takayama</h1>
    <a href="" class="frontlink">フロントエンド</a>
  </header>
  <div class="login">
    <p>DragStoreマスターメンテナンス</p>
    <form action="logincheck.php" method="POST">
      <p class="error"><?=$err_msg ?></p>
      <p>
        ログインID
        <input type="text" name="account" value="">
      </p>
      <p>
        パスワード
        <input type="password" name="password" value="">
      </p>
      <input type="submit" name="login" value="ログイン" class="loginbutton">
    </form>
  </div>
</body>
</html>
