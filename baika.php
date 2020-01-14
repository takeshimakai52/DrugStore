<?php
session_start();
require 'common.php';
$dbh=connect_db();
$sql = "SELECT * FROM saleprice";
$res = $dbh->query($sql);
$start_end_price=[];
$start_price=[];
$future_price=[];
foreach($res as $value){
  $date1=new DateTime($value["fromdate"]);
  $date2=new DateTime($value["todate"]);
  $nowdate = new DateTime('now');
  $test =[]; 
  array_push($test,$value);
  if($date1<$nowdate){
  //始まっている
    if($date2<$nowdate){
    //終わっている
    array_push($start_end_price,$value);
    }else{
    //終わっていない
    array_push($start_price,$value);
    }
  }else{
  //始まっていない
    array_push($future_price,$value);
  }
}
$genresql = "SELECT * FROM genre";
$makersql = "SELECT * FROM maker";
$brandsql = "SELECT * FROM brand";
$genres= $dbh->query($genresql);
$makers= $dbh->query($makersql);
$brands= $dbh->query($brandsql);

function get_sale_item($id){
  $dbh=connect_db();
  $query = "SELECT * FROM item WHERE id = :id";
  $stmt  = $dbh->prepare($query);
  $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $sale_item=$stmt->fetchAll();
  $iteminfo=[];
  foreach($sale_item as $value){
    array_push($iteminfo,$value['id']);
    array_push($iteminfo,$value['name']);
    array_push($iteminfo,$value['genre_id']);
    array_push($iteminfo,$value['brand_id']);
    array_push($iteminfo,$value['maker_id']);
    array_push($iteminfo,$value['price']);
    array_push($iteminfo,$value['component']);
    array_push($iteminfo,$value['catch_copy']);
    array_push($iteminfo,$value['filepath']);
  }
  return $iteminfo;
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
    <link rel="stylesheet"type="text/css"  href="baika.css">
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
          　売価管理(商品一覧)
        </div>
        <div class="maincontents">
          <form action="" method="get">
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
                    <option value="">　　　　　　　　　　　 　</option>
                    <option value="1">ミネラル</option>
                    <option value="2">コスメ</option>
                    <option value="3">健康食品</option>
                  </select>
                </div>
              </div>
              <div class="genre">
                <div class="genreselect">
                  <div class="itemname_title">
                    メーカー
                  </div>
                  <select name="maker">
                    <option value="">　　　　　　　　 　　　　 </option>
                    <option value="1">大塚製薬</option>
                    <option value="2">DHC</option>
                    <option value="3">ファンケル</option>
                  </select>
                </div>
              </div>
              <div class="genre">
                <div class="genreselect">
                  <div class="itemname_title">
                    ブランド
                  </div>
                  <select name="brand">
                    <option value="">　　　　　　　　 　　　　 </option>
                    <option value="1">ネイチャーメイド</option>
                    <option value="2">DHC</option>
                    <option value="3">FANKEL</option>
                    <option value="4">ULOS</option>
                    <option value="5">インナーシグナル</option>
                    <option value="6">カロリーメイト</option>
                    <option value="7">大塚製薬</option>
                  </select>
                </div>
              </div>
              <button type="submit" name="itemsearch" class="itemserch">検索</button>
            </div>
          </form>

          <div class="itemshow">
            <div class="itemshowbox">
              <div class="baikatitle">
                現在、売価変更がされている商品
              </div>
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
                 from
                </div>
                <div class="itembrand">
                  to
                </div>
                <div class="itembrand">
                  
                </div>
                <div class="itembrand">
                  
                </div>
              </div>
<?php
foreach($start_price as $value):
?>
              <div class="syouhin">
                <div class="syouhinnum">
                  <?=get_sale_item($value["item_id"])[0]?>
                </div>
                <div class="syouhingazou">
                  <img src='<?=get_sale_item($value["item_id"])[8]?>' width="60" height="60"　alt="aburitoro" title="炙りトロ">
                </div>
                <div class="syouhinname">
                  <?=get_sale_item($value["item_id"])[1]?>
                </div>
                <div class="syouhinname">
                  <?=get_sale_item($value["item_id"])[5]?>円
                </div>
                <div class="syouhinname">
                  <?=$value["saleprice"]?>円
                </div>
                <div class="syouhingenre">
                  <?=get_genre_name(get_sale_item($value["item_id"])[2])?>
                </div>
                <div class="syouhinmaker">
                  <?=get_maker_name(get_sale_item($value["item_id"])[4])?>
                </div>
                <div class="syouhinbrand">
                  <?=$value["fromdate"]?>
                </div>
                <div class="syouhinbrand">
                  <?=$value["todate"]?>
                </div>
                <form action="baikaedit.php" method="post">
                  <div class="syouhinbtn">
                    <input type="hidden" name="edit_saleprice_item_id" value="<?=$value["item_id"]?>">
                    <input type="hidden" name="edit_saleprice_id" value="<?=$value["id"]?>">
                    <input type="submit" value="売価変更">
                  </div>
                </form>
                <form action="baikaend.php" method="post">
                  <div class="syouhinbtn">
                    <input type="hidden" name="edit_saleprice_item_id" value="<?=$value["item_id"]?>">
                    <input type="hidden" name="edit_saleprice_id" value="<?=$value["id"]?>">
                    <input type="submit" value="終了">
                  </div>
                </form>
              </div>
<?php
endforeach
?>
            </div>

            <div class="itemshowbox">
              <div class="baikatitle">
                売価変更が予定されている商品
              </div>
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
                  from
                </div>
                <div class="itembrand">
                  to
                </div>
                <div class="itembrand">
                
                </div>
                <div class="itembrand">
                  
                </div>
              </div>

<?php
foreach($future_price as $value):
?>
              <div class="syouhin">
                <div class="syouhinnum">
                  <?=get_sale_item($value["item_id"])[0]?>
                </div>
                <div class="syouhingazou">
                  <img src='<?=get_sale_item($value["item_id"])[8]?>' width="60" height="60"　alt="aburitoro" title="炙りトロ">
                </div>
                <div class="syouhinname">
                  <?=get_sale_item($value["item_id"])[1]?>
                </div>
                <div class="syouhinname">
                  <?=get_sale_item($value["item_id"])[5]?>円
                </div>
                <div class="syouhinname">
                  <?=$value["saleprice"]?>円
                </div>
                <div class="syouhingenre">
                  <?=get_genre_name(get_sale_item($value["item_id"])[2])?>
                </div>
                <div class="syouhinmaker">
                  <?=get_maker_name(get_sale_item($value["item_id"])[4])?>
                </div>
                <div class="syouhinbrand">
                  <?=$value["fromdate"]?>
                </div>
                <div class="syouhinbrand">
                  <?=$value["todate"]?>
                </div>
                <form action="baikaedit.php" method="post">
                  <div class="syouhinbtn">
                    <input type="hidden" name="edit_saleprice_item_id" value="<?=$value["item_id"]?>">
                    <input type="hidden" name="edit_saleprice_id" value="<?=$value["id"]?>">
                    <input type="submit" value="売価変更">
                  </div>
                </form>
                <form action="baikadelete.php" method="post">
                  <div class="syouhinbtn">
                    <input type="hidden" name="delete_saleprice_id" value="<?=$value["id"]?>">
                    <input type="submit" value="削除">
                  </div>
                </form>
              </div>
<?php
endforeach
?>
            </div>
          </div>

          <div class="itemshow">
            <div class="itemshowbox">
              <div class="baikatitle">
                過去、売価変更がされていたた商品
              </div>
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
                  from
                </div>
                <div class="itembrand">
                  to
                </div>
                <div class="itembrand">
                
                </div>
                <div class="itembrand">
                  
                </div>
              </div>

<?php
foreach($start_end_price as $value):
?>
              <div class="syouhin">
                <div class="syouhinnum">
                  <?=get_sale_item($value["item_id"])[0]?>
                </div>
                <div class="syouhingazou">
                  <img src='<?=get_sale_item($value["item_id"])[8]?>' width="60" height="60"　alt="aburitoro" title="炙りトロ">
                </div>
                <div class="syouhinname">
                  <?=get_sale_item($value["item_id"])[1]?>
                </div>
                <div class="syouhinname">
                  <?=get_sale_item($value["item_id"])[5]?>円
                </div>
                <div class="syouhinname">
                  <?=$value["saleprice"]?>円
                </div>
                <div class="syouhingenre">
                  <?=get_genre_name(get_sale_item($value["item_id"])[2])?>
                </div>
                <div class="syouhinmaker">
                  <?=get_maker_name(get_sale_item($value["item_id"])[4])?>
                </div>
                <div class="syouhinbrand">
                  <?=$value["fromdate"]?>
                </div>
                <div class="syouhinbrand">
                  <?=$value["todate"]?>
                </div>
                <form action="" method="GET">
                  <div class="syouhinbtn">
                    <!-- <input type="submit" value="売価変更"> -->
                  </div>
                </form>
                <form action="" method="GET">
                  <div class="syouhinbtn">
                    <!-- <input type="submit" value="削除"> -->
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