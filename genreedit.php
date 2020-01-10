<?php
  require 'common.php';
  try{
    $dbh=connect_db();
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }

  $editid = filter_input(INPUT_POST, 'editid');
  $editname = filter_input(INPUT_POST, 'editname');

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
          　ジャンル編集
        </div>
        <div class="maincontents">
          <div class="haku"></div>
          <form action="genreeditconfirm.php" method="post">
            <div class="touroku">
              <div class="touroku_head">
                ジャンル情報
              </div>
              <div class="syouhinrow">
                <div class="rowleft">
                  ジャンルNo
                </div>
                <div class="rowright">
                  <?= $editid ?>
                  <input type='hidden' name='genreid' value='<?=$editid ?>'>
                </div>
              </div>
              <div class="syouhinrow">
                <div class="rowleft">
                  ジャンル名
                </div>
                <div class="rowright">
                  <input type="text" class="textrightbox" name="genrename" value="<?=$editname?>">
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