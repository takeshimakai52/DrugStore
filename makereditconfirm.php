<?php
	require 'common.php';
	function genre_edit(){
		// POSTではないとき何もしない
		if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
				return;
		}

		$genre = filter_input(INPUT_POST, 'genre');
		if ('' === $genre) {
				throw new Exception('ジャンルは入力必須です。');
		}
		$id = filter_input(INPUT_POST, 'id');
		$dbh=connect_db();
		$sql2 = "UPDATE maker SET name = :name WHERE id = :id";
		$stmt = $dbh->prepare($sql2);
		$params = array(':name' => "$genre", ':id' => "$id");
		$stmt->execute($params);
  }

  try{
		genre_edit();
		
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet"type="text/css"  href="kari.css">
    <link rel="stylesheet"type="text/css"  href="itemnew.css">
    <link rel="stylesheet"type="text/css"  href="normalize.css">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="vali.js"></script>
  </head>
  <body>
    <div class="header">
      <div class="icon">
        drug takayama
      </div>
      <div class="frontlink">
        <a href="" class="frontbtn">
          フロントエンド
        </a>
      </div>
      <div class="logoutbtn">
        <a href="" class="logout">
          ログアウト
        </a>
      </div>
    </div>
    
    <div class="ohako">
      <div class="sidebar">
        <ul class="menu">
          <li>
            <a href="" class="listmenu">商品一覧</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href=""class="listmenu">商品登録</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href="genre.php" class="listmenu">ジャンル管理</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href="maker.php" class="listmenu">メーカー管理</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href="" class="listmenu">ブランド管理</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href="" class="listmenu">売価管理</a>
          </li>
          <div class="kasen"></div>
        </ul>
      </div>
      <div class="main">
        <div class="maintitle">
          　メーカー編集
        </div>
        <div class="maincontents">
					<div class="haku"></div>
					<div class="genreconfirm">
            <div class="confirmmessage">
							メーカーを編集しました
						</div>
						<div class="genrelink">
						  <a href="maker.php">メーカー一覧にも戻る</a>
						</div>
					</div>
        </div>

      </div>
    </div>
  </body>
</html>