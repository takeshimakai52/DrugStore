<?php
  require 'common.php';
  try{
    $dbh=connect_db();
    // $sql = "select * from present order by id desc limit 1;
    $sql = "SELECT * FROM maker order by id desc limit 1";
    $res = $dbh->query($sql);
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }
 foreach( $res as $value ) {
   $a="$value[id]";
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
          　メーカー登録
        </div>
        <div class="maincontents">
          <div class="haku"></div>
          <form action="makerconfirm.php" method="post">
            <div class="touroku">
              <div class="touroku_head">
                メーカー情報
              </div>
              <div class="syouhinrow">
                <div class="rowleft">
                  メーカーNo
                </div>
                <div class="rowright">
                  <?= $a+1 ?>
                </div>
              </div>
              <div class="syouhinrow">
                <div class="rowleft">
                  メーカー名
                </div>
                <div class="rowright">
                  <input type="text" class="textrightbox" name="genre">
                </div>
              </div>
              

              <div class="tourokubtn">
                <button type="submit" name="itemsearch" class="itemserch">登録</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </body>
</html>