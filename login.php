<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="ectest.css">
  <script type="text/javascript" src=""></script>
  <?php
  session_start();
// データベースに接続するために必要なデータソースを変数に格納
  // mysql:host=ホスト名;dbname=データベース名;charset=文字エンコード
$dsn = 'mysql:host=localhost;dbname=sumple;charset=utf8';
  // データベースのユーザー名
$user = 'root';
  // データベースのパスワード
$password = '';
// tryにPDOの処理を記
try {
  // PDOインスタンスを生成
  $dbh = new PDO($dsn, $user, $password);
// エラー（例外）が発生した時の処理を記述
} catch (PDOException $e) {
  // エラーメッセージを表示させる
  echo 'データベースにアクセスできません！' . $e->getMessage();
  // 強制終了
  exit;
}
// SELECT文を変数に格納
$sql = "SELECT * FROM youseracount";
// SQLステートメントを実行し、結果を変数に格納
$stmt = $dbh->query($sql);
// foreach文で配列の中身を一行ずつ出力
$errorMessage = '';
foreach ($stmt as $row) {
  // ログインボタンを押したときの動作
  if(isset($_POST['login'])){
  if($_POST['account'] == $row['account'] && $_POST['password'] == $row['password']){
    header('location: yamadatop.php');
    exit;
  }elseif (empty($_POST["account"]) && empty($_POST["password"])) {
    $errorMessage = "ログインIDとパスワードが未入力です。";
  } else if (empty($_POST["password"])) {
    $errorMessage = "パスワードが未入力です。";
  } else if (empty($_POST["account"])) {
    $errorMessage = "ログインIDが未入力です。";
  }else{
    $errorMessage = 'ログインIDまたはパスワードが間違っています。';
  }
}
}

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
      <p><?php echo $errorMessage ?></p>
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
