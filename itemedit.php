<?php
  require 'common.php';
  $editid = filter_input(INPUT_POST, 'editid');

  function get_edit_item($id){
    $dbh=connect_db();
    $query = "SELECT * FROM item WHERE id = :id";
    $stmt  = $dbh->prepare($query);
    $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $tagitem=$stmt->fetchAll();
    return $tagitem;
  }

  $tagedititem=get_edit_item($editid);

  foreach($tagedititem as $value){
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
  $disp_image='<img src="$editfilepath">';


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

  try{
    $dbh=connect_db();
    //$edititem = get_edititem();

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
    <script src="item.js"></script>
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
          　商品編集
        </div>
        <div class="maincontents">
        <div class="haku"></div>
        <form action="itemeditconfirm.php" method="post" enctype="multipart/form-data">
          <div class="touroku">
            <div class="touroku_head">
              商品情報
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                商品No
              </div>
              <div class="rowright">
                <?=$editid?>
                <input type="hidden" name="id" value="<?=$editid?>">
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                商品名
              </div>
              <div class="rowright">
                <input type="text" class="textrightbox" name="name" value="<?=$editname?>">
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                通常価格
              </div>
              <div class="rowright">
                <input type="text" class="textrightbox" name="price" value="<?=$editprice?>">
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                ジャンル
              </div>
              <div class="rowright">
                <select class="textrightbox" name="itemgenre">
                  <option value="<?=$editgenreid?>"><?=get_genre_name($editgenreid)?> </option>
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
                <select class="textrightbox" name="itemmaker" onchange="changebrand()">
                  <option value="<?=$editmakerid?>"><?=get_maker_name($editmakerid)?></option>
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
                <select  class="textrightbox" id="brandselect" name="itembrand">
                  <option value="<?=$editbrandid?>"><?=get_brand_name($editbrandid)?></option>
<?php
foreach($brands as $value):
?>
                  <option disabled value="<?=$value['id']?>" name="brandoption<?=$value['maker_id']?>"><?=$value['name']?></option>
<?php
endforeach
?>
                </select>
              </div>
            </div>

            <div class="syouhinrow">
              <div class="rowleft">
                現在の商品画像
              </div>
              <div class="rowright">
                <img src="<?=$editfilepath?>" width="100" height="100"　alt="aburitoro" title="炙りトロ">
                <input type="hidden" name="oldpath" value="<?=$editfilepath?>">
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                新規商品画像
              </div>
              <div class="rowright">
                <input type="file" name="image">
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                成分
              </div>
              <div class="rowright">
                <textarea name="seibun" rows="5" class="textrightbox" ><?=$editcomponent?></textarea>
              </div>
            </div>
            <div class="syouhinrow">
              <div class="rowleft">
                商品説明
              </div>
              <div class="rowright">
                <textarea name="catch_copy" rows="5" class="textrightbox" ><?=$editcatch_copy?></textarea>
              </div>
            </div>
            <div class="tourokubtn">
              <button type="submit" name="itemsearch" class="itemserch" onclick='return confirm("本当に変更しますか？");'/>登録</button>
            </div>
          </div>
        </form>
        </div>

      </div>

    </div>
  </body>
</html>
