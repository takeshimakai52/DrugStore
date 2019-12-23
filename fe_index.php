<!DOCTYPE html>
<?php
function connect_db()
{
  $dsn = 'mysql:host=localhost;dbname=item;charset=utf8';
  $username = 'root';
  $password = '';
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];
  return new PDO($dsn, $username, $password, $options);
}
try {
  // DBに接続する
  $dbh = connect_db();
  $sql = "SELECT * FROM itemname";
  $res = $dbh->query($sql);
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}

$names=[];
$genres=[];
$brands=[];
$manufacturers=[];
$prices=[];
$components=[];
$sellings=[];
$images=[];

 foreach($res as $value){
   array_push($names, $value['name']);
   array_push($genres, $value['genre']);
   array_push($brands, $value['brand']);
   array_push($manufacturers, $value['manufacturer']);
   array_push($prices, $value['price']);
   array_push($components, $value['component']);
   array_push($sellings, $value['selling']);
   array_push($images, $value['image']);
 }

 // var_dump ($names);
 // var_dump ($genres);
 // var_dump ($brands);
 // var_dump ($manufacturers);
 // var_dump ($prices);
 // var_dump ($components);
 // var_dump ($sellings);
 // var_dump ($images);


?>

<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>YTYDrugStore</title>
  <link rel="stylesheet" href="frontEnd_style.css">
</head>
<body>
  <div class="frontEnd_header">
    <span class="YTYTopLink_wrap">
      <a href="http://localhost/php/shop/">YTYDrugStore</a>
    </span>
    <span class="searchByKeyword_wrap">
      <input type="text" name="searchByKeyword_box">
    </span>
    <span class="searchButton_wrap">
      <input type="button" name="searchButton_button" value="検索">
    </span>
    <span>
      <a href="">ログイン</a>
    </span>
  </div>
  <div class="sideMenu">
    <h2>
      ジャンル
    </h2>
    <div>
      <?php foreach($genres as $value) {
        echo $value;
      } ?>
      </div>
      <h2>メーカー</h2>
      <div>
        <?php foreach($manufacturers as $value) {
          echo $value;
        } ?>
      </div>
      <h2>ブランド</h2>
      <?php foreach($brands as $value) {
        echo $value;
      } ?>
    </div>
    <div class="productList">
      <h1>
        商品一覧
      </h1>
      <?php foreach($names as $value) {
        echo $value;
      } ?>
      <?php foreach($prices as $value) {
        echo $value;
      } ?>
      <?php foreach($genres as $value) {
        echo $value;
      } ?>
      <?php foreach($manufacturers as $value) {
        echo $value;
      } ?>
      <?php foreach($brands as $value) {
        echo $value;
      } ?>
    </div>
  </body>
</html>
