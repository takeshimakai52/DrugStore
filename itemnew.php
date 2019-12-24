<?php
  require 'common.php';
  try{
    $dbh=connect_db();
    $sql = "SELECT * FROM item order by id desc limit 1";
    $res = $dbh->query($sql);

    $sql2 = "SELECT * FROM maker";
    $makers = $dbh->query($sql2);

    $sql3 = "SELECT * FROM genre";
    $genres = $dbh->query($sql3);

    $sql4 = "SELECT * FROM brand";
    $brands = $dbh->query($sql4);

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
<?php include(dirname(__FILE__).'/assets/sidebar.php'); ?>
      <div class="main">
        <div class="maintitle">
          　商品登録
        </div>
        <div class="maincontents">
        <div class="haku"></div>
        <form action="itemconfirm.php" method="post" enctype="multipart/form-data"> 
          <div class="touroku">
            <div class="touroku_head">
              商品情報
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                商品No
              </div>
              <div class="rowright">
                <?=$a+1?>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                商品名
              </div>
              <div class="rowright">
                <input type="text" class="textrightbox" name="name">
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                通常価格
              </div>
              <div class="rowright">
                <input type="text" class="textrightbox" name="price">
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                ジャンル
              </div>
              <div class="rowright">
                <select name="genre" class="textrightbox" name="itemgenre">
                  <option value="">---　　　　　　　　 　　　　 </option>
<?php
foreach($genres as $value):
?>                 
                  <option value="<?=$value['id']?>"><?=$value['name']?></option>
<?php
endforeach
?>
                </select>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                メーカー
              </div>
              <div class="rowright">
                <select name="maker" class="textrightbox" name="itemmaker">
                  <option value="">---　　　　　　　　 　　　　 </option>
<?php
foreach($makers as $value):
?>                 
                  <option value="<?=$value['id']?>"><?=$value['name']?></option>
<?php
endforeach
?>
                </select>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                ブランド
              </div>
              <div class="rowright">
<!-- 上記のメーカーが選択されていたら、そのidに紐づくbrand以外はjsで非表示にする -->
                <select name="brand" class="textrightbox">
                  <option value="">---　　　　　　　　 　　　　 </option>
<?php
foreach($brands as $value):
?>                 
                  <option value="<?=$value['id']?>"　name="<?=$value['maker_id']?>"><?=$value['name']?></option>
<?php
endforeach
?>
                </select>
              </div>
            </div>

            <div class="syouhinrow">
              <div class="rowleft">
                商品画像
              </div>
              <div class="rowright">
                <input type="file" name="pic">
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                成分
              </div>
              <div class="rowright">
                <textarea name="seibun" rows="5" class="textrightbox" ></textarea>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                商品説明
              </div>
              <div class="rowright">
                <textarea name="description" rows="5" class="textrightbox" ></textarea>
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