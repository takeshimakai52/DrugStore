<?php
  require 'common.php';

  // $res = maker_getData($id);

//   try{
//     $dbh=connect_db();
//     $sql = "SELECT * FROM maker order by id desc limit 1";
//     $res = $dbh->query($sql);
//   }catch(PDOException $e) {
//     echo $e->getMessage();
//     die();
//  }
//  foreach( $res as $value ) {
//    $a="$value[id]";
//   }

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
          <form name="makereditconfirm" action="makereditconfirm.php" method="post">
            <div class="touroku">
              <div class="touroku_head">
                メーカー情報
              </div>
              <div class="syouhinrow">
                <div class="rowleft">
                  メーカーNo
                </div>
                <div class="rowright">
                  <?= $editid ?>
                  <input type='hidden' name='makerid' value='<?=$editid ?>'>
                </div>
              </div>
              <div class="syouhinrow">
                <div class="rowleft">
                  メーカー名
                </div>
                <div class="rowright">
                  <input type="text" class="textrightbox" name="makername" id="maker_edit" value="<?=$editname?>">
                </div>
              </div>


              <div class="tourokubtn">
                <button type="button" name="itemsearch" class="itemserch" onclick="maker_editempty();">登録</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </body>
</html>
