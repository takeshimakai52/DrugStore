<?php
  require 'common.php';
  $editid = filter_input(INPUT_POST, 'editid');
  $editname = filter_input(INPUT_POST, 'editname');
  $editmaker_id = filter_input(INPUT_POST, 'editmaker_id');

  function maker_name($maker_id){
    $dbh=connect_db();
    $query = "SELECT * FROM maker WHERE id = :maker_id";
    $stmt  = $dbh->prepare($query);
    $stmt -> bindValue(':maker_id', $maker_id, PDO::PARAM_INT);
    $stmt->execute();
    $maker=$stmt->fetchAll();
    foreach($maker as $value){
      $maker_name=$value['name'];
    }
    return $maker_name;
  }

  try{
    $dbh=connect_db();
    $sql2 = "SELECT * FROM maker";
    $res2 = $dbh->query($sql2);
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
<?php include(dirname(__FILE__).'/assets/sidebar.php'); ?>
      <div class="main">
        <div class="maintitle">
          　ブランド編集
        </div>
        <div class="maincontents">
          <div class="haku"></div>
          <form name="brandeditconfirm" action="brandeditconfirm.php" method="post">
            <div class="touroku">
              <div class="touroku_head">
                ブランド情報
              </div>
              <div class="syouhinrow">
                <div class="rowleft">
                  ブランドNo
                </div>
                <div class="rowright">
                  <?= $editid ?>
                  <input type='hidden' name='id' value='<?=$editid ?>'>
                </div>
              </div>
              <div class="syouhinrow">
                <div class="rowleft">
                  ブランド名
                </div>
                <div class="rowright">
                  <input type="text" class="textrightbox" name="genre" id="brand_edit" value="<?=$editname?>">
                </div>
              </div>
              <div class="syouhinrow">
                <div class="rowleft">
                  メーカー名
                </div>
                <div class="rowright">
                  <select name="maker_id">
                    <option value="<?=$editmaker_id?>"><?=maker_name($editmaker_id)?></option>
<?php
foreach($res2 as $value):
?>
                    <option value="<?=$value['id']?>"><?=$value['name']?></option>
<?php
endforeach
?>
                  </select>
                </div>
              </div>


              <div class="tourokubtn">
                <button type="button" name="itemsearch" class="itemserch" onclick="brand_editempty();">登録</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </body>
</html>
