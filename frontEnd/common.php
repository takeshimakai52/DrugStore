<?php

// 文字化け対策
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'");
// エラーを表示する
error_reporting(E_ALL & ~E_NOTICE);

// 定数宣言
define('dbName', 'shop');
define('dbDsn','mysql:dbhost=localhost;dbname=' . dbName);
define('dbUser', 'root');
define('dbPssword', '');
define('dbCharset', 'utf8');

try {
  // DBに接続する
  $dbh = new PDO(dbDsn,dbUse,dbPassword);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // itemの全データを取得して、変数$sqlに格納
  $sql = 'SLECT * FROM item';
  // SQLステートメント(命令文)を実行して、結果を変数$stmtに格納
  $stmt = $dbh->query($sql);
  // foreach文で、配列の中身を１行ずつ出力
};

?>
