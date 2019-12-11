<?php
	require 'common.php';
	function genre_upload(){
		// POSTではないとき何もしない
		if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
				return;
		}

		$genre = filter_input(INPUT_POST, 'genre');
		if ('' === $genre) {
				throw new Exception('ジャンルは入力必須です。');
		}

		$sql2 = 'INSERT INTO `genre` (`id`,`name`) VALUES (NULL, :genre) ';
		$arr = [];
		$arr[':genre'] = $genre;
		insert($sql2, $arr);
  }

  try{
    $dbh=connect_db();
		genre_upload();
		
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
            <a href="" class="listmenu">ジャンル管理</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href="" class="listmenu">メーカー管理</a>
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
          　ジャンル登録
        </div>
        <div class="maincontents">
					<div class="haku"></div>
					<div class="genreconfirm">
            <div class="confirmmessage">
							ジャンルを登録しました
						</div>
						<div class="genrelink">
						  <a href="genre.php">ジャンル一覧にも戻る</a>
						</div>
					</div>
        </div>

      </div>
    </div>
  </body>
</html>