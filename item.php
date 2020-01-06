<?php
require 'common.php';
$dbh=connect_db();
$sql = "SELECT * FROM item";
$res = $dbh->query($sql);
if(isset($_SESSION["searchres"])){
  $res = $_SESSION["searchres"];
}
$genresql = "SELECT * FROM genre";
$makersql = "SELECT * FROM maker";
$brandsql = "SELECT * FROM brand";
$genres= $dbh->query($genresql);
$makers= $dbh->query($makersql);
$brands= $dbh->query($brandsql);


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
          　商品一覧(商品管理)
        </div>
        <div class="maincontents">
          <form action="itemsearch.php" method="post">
            <div class="serchbox">
              <div class="itemname">
                <div class="itemname_title">
                  商品名
                </div>
                <input type="text" name="itemname">
              </div>
              <div class="genre">
                <div class="genreselect">
                  <div class="itemname_title">
                    ジャンル
                  </div>
                  <select name="genre">
                    <option value="">---　　　　　　　　　　　</option>
<?php
foreach($genres as $value):
?>
                  <option value="<?=$value["id"]?>"><?=$value["name"]?></option>
<?php
endforeach
?>
                  </select>
                </div>
              </div>
              <div class="genre">
                <div class="genreselect">
                  <div class="itemname_title">
                    メーカー
                  </div>
                  <select name="maker">
                  <option value="">---　　　　　　　　　　　 </option>
<?php
foreach($makers as $value):
?>
                  <option value="<?=$value["id"]?>"><?=$value["name"]?></option>
<?php
endforeach
?>
                  </select>
                </div>
              </div>
              <div class="genre">
                <div class="genreselect">
                  <div class="itemname_title">
                    ブランド
                  </div>
                  <select name="brand">
                  <option value="">---　　　　　　　　　　　 </option>
<?php
foreach($brands as $value):
?>
                  <option value="<?=$value["id"]?>"><?=$value["name"]?></option>
<?php
endforeach
?>
                  </select>
                </div>
              </div>
              <button type="submit" name="itemsearch" class="itemserch">検索</button>
            </div>
          </form>
          <form action="itemnew.php" method="post">
            <div class="serchbox">
              <button type="submit" name="itemsearch" class="itemserch">登録画面へ</button>
            </div>
          </form>
          <div class="itemshow">
            <div class="itemshowbox">
              <div class="itemlabel">
                <div class="itemnum">
                  No.
                </div>
                <div class="itempic">
                  画像
                </div>
                <div class="itemmei">
                  商品名
                </div>
                <div class="itemmei">
                  通常価格
                </div>
                <div class="itemmei">
                  販売価格
                </div>
                <div class="itemgenre">
                  ジャンル
                </div>
                <div class="itemmaker">
                  メーカー
                </div>
                <div class="itembrand">
                  ブランド
                </div>
                <div class="itembrand">
                
                </div>
                <div class="itembrand">
                
                </div>
                <div class="itembrand">
                  
                </div>
              </div>
<?php
foreach($res as $value):
?>
              <div class="syouhin">
                <div class="syouhinnum">
                  <?=$value["id"]?>
                </div>
                <div class="syouhingazou">
                  <img src="<?=$value["filepath"]?>" width="60" height="60"　alt="aburitoro" title="炙りトロ">
                </div>
                <div class="syouhinname">
                  <?=$value["name"]?>
                </div>
                <div class="syouhinname">
                  <?=$value["price"]?>円
                </div>
                <div class="syouhinname">
                  <?=$value["price"]?>円
                </div>
                <div class="syouhingenre">
                  <?=get_genre_name($value["genre_id"])?>
                </div>
                <div class="syouhinmaker">
                  <?=get_maker_name($value["maker_id"])?>
                </div>
                <div class="syouhinbrand">
                  <?=get_maker_name($value["brand_id"])?>
                </div>
                <form action="" method="GET">
                  <div class="syouhinbtn1">
                      <input type="submit" value="編集">
                  </div>
                </form>
                <form action="" method="GET">
                  <div class="syouhinbtn">
                    <input type="submit" value="売価変更">
                  </div>
                </form>
                <form action="" method="GET">
                  <div class="syouhinbtn">
                    <input type="submit" value="削除">
                  </div>
                </form>
              </div>
<?php
endforeach
?>
            </div>

          </div>
        </div>

      </div>

    </div>
  </body>
</html>