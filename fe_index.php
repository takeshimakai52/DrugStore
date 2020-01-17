<!DOCTYPE html>
<?php
function connect_db() {
  $dsn = 'mysql:host=localhost;dbname=sample;charset=utf8';
  $username = 'root';
  $password = '';
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];
  return new PDO($dsn, $username, $password, $options);
} try {
  $dbh = connect_db();
  $sql = "SELECT
  item.*,
  brand.name as brand_name,
  genre.name as genre_name,
  maker.name as maker_name
  FROM
  item
  INNER JOIN
  brand
  ON item.brand_id = brand.id
  INNER JOIN
  genre
  ON item.genre_id = genre.id
  INNER JOIN
  maker
  ON item.maker_id = maker.id";
  $res = $dbh->query($sql);
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}
function search_saleprice($item_id,$start_price,$price){
  $item_id_array=array_column($start_price, 'item_id');
  $testresult = array_search($item_id, $item_id_array);
  if($testresult===false){
    return $price;
  }else{
    return $start_price[$testresult]["saleprice"];
  }
}
$sql = "SELECT * FROM saleprice";
$salepriceis = $dbh->query($sql);
$start_end_price=[];
$start_price=[];
$future_price=[];
foreach($salepriceis as $value){
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

?>

<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>DrugStore</title>
  <link rel="stylesheet" type="text/css" href="fe_style.css">
</head>
<body>
  <header>
    <div class="title">
      <a name="topLink" href="/DrugStore/fe_index.php">
        <h1>drug takayama</h1>
      </a>
    </div>
    <div class="search">
      <input type="text" name="searchBox_input">
      <input type="button" name="searchButton_button" value="検索">
    </div>
    <div class="login">
      <a href="">ログイン</a>
    </div>
  </header>
</div>
<div class="div_sideMenu">
  <p class="h_sideMenu"><h3>ジャンル</h3></p>
  <ul>
    <a href="">
      <li>
        健康食品
      </li>
    </a>
    <a href="">
      <li>
        コスメ
      </li>
    </a>
    <a href="">
      <li>
        ビタミン
      </li>
    </a>
    <a href="">
      <li>
        ミネラル
      </li>
    </a>
  </ul>
  <p class="h_sideMenu"><h3>メーカー</h3></p>
  <ul>
    <a href="">
      <li>
        DHC
      </li>
    </a>
    <a href="">
      <li>
        大塚製薬
      </li>
    </a>
    <a href="">
      <li>
        ファンケル
      </li>
    </a>
  </ul>
  <p class="h_sideMenu"><h3>ブランド</h3></p>
  <ul>
    <a href="">
      <li>
        DHC
      </li>
    </a>
    <a href="">
      <li>
        FANCL
      </li>
    </a>
    <a href="">
      <li>
        ULOS
      </li>
    </a>
    <a href="">
      <li>
        インナーシグナル
      </li>
    </a>
    <a href="">
      <li>
        大塚製薬
      </li>
    </a>
    <a href="">
      <li>
        カロリーメイト
      </li>
    </a>
    <a href="">
      <li>
        ネイチャーメイド
      </li>
    </a>
  </ul>
</div>
<div class="div_productList">
  <p class="ichiranTitle">
    <h2>商品一覧</h2>
  </p>
    <?php foreach($res as $value): ?>
      <hr>
        <div class="div_item">
          <div class="div_image">
            <a href="/DrugStore/fe_itemDetail.php?id=<?= $value['id'] ?>">
              <img src="<?= $value['filepath'] ?>" alt="" width="200" height="200">
            </a>
          </div>
          <div class="div_itemInfo">
              <h3>商品名：<?= $value['name'] ?></h3>
              <div class="detailInfo">
<?php
if(search_saleprice($value["id"],$start_price,$value["price"])==$value["price"]):
?>
              価格：￥<?= $value['price'] ?><br>
<?php
else:
?>
              価格：￥<?=search_saleprice($value["id"],$start_price,$value["price"])?><br>
<?php
endif
?>
              <dr>
              ジャンル：<?= $value['genre_name'] ?><br>
              ブランド：<?= $value['brand_name'] ?><br>
              メーカー：<?= $value['maker_name'] ?><br>
            </div>
            </div>
              <input name="genre" type="hidden" value="<?php $value['id'] ?>">
            </div>
        <?php endforeach ?>
        <hr>
    </div>
  </body>
</html>
