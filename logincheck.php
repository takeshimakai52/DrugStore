<?php
session_start();
if(isset($_SESSION['err_msg'])){
  unset($_SESSION['err_msg']);
}
// データベースに接続するために必要なデータソースを変数に格納
// mysql:host=ホスト名;dbname=データベース名;charset=文字エンコード
$dsn = 'mysql:host=localhost;dbname=sample;charset=utf8';
// データベースのユーザー名 パスワード
$user = 'root';
$password = '';
$_SESSION['account'] = $_POST['account'];
$_SESSION['password'] = $_POST['password'];
// tryにPDOの処理を記術
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
$sql = "SELECT userid FROM youseracount WHERE account = :account and password = :password;";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':account',$_POST["account"], PDO::PARAM_STR);
$stmt->bindValue(':password',$_POST["password"], PDO::PARAM_STR);

// SQLステートメントを実行し、入力されたユーザーID・パスワードに合致するデータの件数を取得
$stmt->execute();
$count=$stmt->rowCount();
//LOGIN成功→商品一覧画面へ　LOGIN失敗→元の画面へ　遷移させる
if($count==1){
  header('location: item.php');
  exit;
}elseif(isset($_POST['account']) && isset($_POST['password']) && $count !== 1){
  $err_msg = 'ログインIDかパスワードが間違っています';
  $_SESSION['err_msg'] = $err_msg;
  header('location: login.php');
  exit;
}
?>
