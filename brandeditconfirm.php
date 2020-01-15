<?php
	require 'common.php';
  $brand = filter_input(INPUT_POST, 'genre');
  $id = filter_input(INPUT_POST, 'id');
  $maker_id = filter_input(INPUT_POST, 'maker_id');
  try{
	  brand_edit($brand,$maker_id,$id);

  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }
 header('location: brand.php');
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
<?php include(dirname(__FILE__).'/assets/sidebar.php'); ?>
      <div class="main">
        <div class="maintitle">
          　ブランド編集
        </div>
        <div class="maincontents">
					<div class="haku"></div>
					<div class="genreconfirm">
            <div class="confirmmessage">
							ブランドを編集しました
						</div>
						<div class="genrelink">
						  <a href="brand.php">ブランド一覧に戻る</a>
						</div>
					</div>
        </div>

      </div>
    </div>
  </body>
</html>
