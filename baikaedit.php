<?php
require 'common.php';
$id = filter_input(INPUT_POST, 'edit_saleprice_id');
$itemid = filter_input(INPUT_POST, 'edit_saleprice_item_id');

function get_edit_saleprice($id){
  $dbh=connect_db();
  $query = "SELECT * FROM saleprice WHERE id = :id";
  $stmt  = $dbh->prepare($query);
  $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $tagsaleprice=$stmt->fetchAll();
  return $tagsaleprice;
}

$tageditsaleprice=get_edit_saleprice($id);

foreach($tageditsaleprice as $value){
  $editid = $value["id"];
  $editsaleprice =  $value["saleprice"];
  $editfrom = $value["fromdate"];
  $editto = $value["todate"];
}

function get_item_to_baika($id){
  $dbh=connect_db();
  $query = "SELECT * FROM item WHERE id = :id";
  $stmt  = $dbh->prepare($query);
  $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $tagitem=$stmt->fetchAll();
  return $tagitem;
}
$tagitem_to_baika=get_item_to_baika($itemid);

foreach($tagitem_to_baika as $value){
  $editid = $value["id"];
  $editname =  $value["name"];
  $editprice = $value["price"];
  $editgenreid = $value["genre_id"];
  $editmakerid = $value["maker_id"];
  $editbrandid = $value["brand_id"];
  $editcomponent=$value["component"];
  $editcatch_copy=$value["catch_copy"];
  $editfilepath=$value["filepath"];
}

function get_maker_name($maker_id){
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

function get_genre_name($genre_id){
  $dbh=connect_db();
  $query = "SELECT * FROM genre WHERE id = :genre_id";
  $stmt  = $dbh->prepare($query);
  $stmt -> bindValue(':genre_id', $genre_id, PDO::PARAM_INT);
  $stmt->execute();
  $genre=$stmt->fetchAll();
  foreach($genre as $value){
    $genre_name=$value['name'];
  }
  return $genre_name;
}

function get_brand_name($brand_id){
  $dbh=connect_db();
  $query = "SELECT * FROM brand WHERE id = :brand_id";
  $stmt  = $dbh->prepare($query);
  $stmt -> bindValue(':brand_id', $brand_id, PDO::PARAM_INT);
  $stmt->execute();
  $brand=$stmt->fetchAll();
  foreach($brand as $value){
    $brand_name=$value['name'];
  }
  return $brand_name;
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
          　売価管理(売価変更)
        </div>
        <div class="maincontents">
          <div class="haku"></div>
          <div class="touroku">
            <div class="touroku_head">
              商品情報
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                販売価格No
              </div>
              <div class="rowright">
                <?=$id?>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                商品No
              </div>
              <div class="rowright">
                <?=$editid?>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                商品名
              </div>
              <div class="rowright">
                <?=$editname?>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                通常価格
              </div>
              <div class="rowright">
                <?=$editprice?>円
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                ジャンル
              </div>
              <div class="rowright">
                <?=get_genre_name($editgenreid)?>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                メーカー
              </div>
              <div class="rowright">
                <?=get_maker_name($editmakerid)?>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                ブランド
              </div>
              <div class="rowright">
                <?=get_brand_name($editbrandid)?>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                商品画像
              </div>
              <div class="rowright">
                  <img src="<?=$editfilepath?>" width="100" height="100"　alt="aburitoro" title="炙りトロ">
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                成分
              </div>
              <div class="rowright">
                <?=$editcomponent?>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                商品説明
              </div>
              <div class="rowright">
                <?=$editcatch_copy?>
              </div>
            </div>
<!-- フォームはここから -->
            <form action="baikaeditconfirm.php" method="post">
              <input type="hidden" name="baikaid" value="<?=$id?>">
              <input type="hidden" name="item_id_to_baika" value="<?=$itemid?>">
            <div class="syouhinrow">
              <div class="rowleft">
                販売価格(変更後の価格)
              </div>
              <div class="rowright">
                <input type="text" name="saleprice"  class="textrightbox" value="<?=$editsaleprice?>" required>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                from
              </div>
              <div class="rowright">
                <input type="date" name="fromdate" class="textrightbox" value="<?=$editfrom?>" required>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                to
              </div>
              <div class="rowright">
                <input type="date" name="todate" class="textrightbox" value="<?=$editto?>" required>
              </div>
            </div>

            <div class="tourokubtn">
              <button type="submit" name="itemsearch" class="itemserch">登録</button>
            </div>
            </form>
          </div>
        </div>

      </div>

    </div>
  </body>
</html>