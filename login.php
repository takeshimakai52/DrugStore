<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="ectest.css">
  <script type="text/javascript" src=""></script>
  <?php
  session_start();
  $sql = "SELECT * FROM youseracount";
  $res = $dbh->query($sql);
    ?>
    <title>マスターメンテナンスログイン</title>
  </head>
  <body>
    <header>
      <h1>Drag Takayama</h1>
      <a href="" class="frontlink">フロントエンド</a>
    </header>
    <div class="login">
      <p>DragStoreマスターメンテナンス</p>
      <form action="" method="POST">
        <p>
          ログインID
          <input type="text" name="account">
        </p>
        <p>
          パスワード
          <input type="text" name="password">
        </p>
      </form>
      <form action="yamadatop.php" method="POST">
        <input type="submit" value="ログイン" class="loginbutton">
      </form>
    </div>
  </body>
  </html>
