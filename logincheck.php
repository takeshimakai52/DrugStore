<?php
    session_start();
    // データベースに接続するために必要なデータソースを変数に格納
    // mysql:host=ホスト名;dbname=データベース名;charset=文字エンコード
    $dsn = 'mysql:host=localhost;dbname=sample;charset=utf8';
    // データベースのユーザー名 パスワード
    $user = 'root';
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

    if(!isset($_POST['account'])){
        $_SESSION['err_msg'] = "ユーザーIDに入力がありませんでした。";
        header('location: login.php');
        exit;
    }
    if(!isset($_POST['password'])){
        $_SESSION['err_msg'] = "パスワードに入力がありませんでした。";
        header('location: login.php');
        exit;
    }

    // SELECT文を変数に格納
    $sql = "SELECT userid FROM youseracount WHERE account = :username and password = :password;";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':username',$_POST["account"], PDO::PARAM_STR);
    $stmt->bindValue(':password',$_POST["password"], PDO::PARAM_STR);

    // SQLステートメントを実行し、入力されたユーザーID・パスワードに合致するデータの件数を取得
   $stmt->execute();
    $count=$stmt->rowCount();

    //LOGIN成功→商品一覧画面へ　LOGIN失敗→元の画面へ　遷移させる。
    if($count==1){
        header('location: itemitiran.html');
        exit;
    }else{
        $_SESSION['err_msg'] = "ユーザーID・パスワードのいずれかが違います。";
//        header('location: login.php');
print $sql;
        exit;
    }

?>
