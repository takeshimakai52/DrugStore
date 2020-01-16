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
  $pickId = $_GET['id'];
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
  ON item.maker_id = maker.id
  WHERE
  item.id = $pickId";
  $res = $dbh->query($sql);
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
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
        <h1>DrugStore</h1>
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
  <hr>
  <div class="div_items">
    <?php foreach($res as $value): ?>
      <div class="div_item">
        <div class="detail_image">
          <img src="./fe_img/<?= $value['filepath'] ?>" alt="" width="200" height="200">
        </div>
        <div class="detail_itemInfo">
          <h2>商品名：<?= $value['name'] ?></h2><br>
          価格：￥<?= $value['price'] ?><br><br>
          <dr>
            ジャンル：<?= $value['genre_name'] ?><br><br>
            ブランド：<?= $value['brand_name'] ?><br><br>
            メーカー：<?= $value['maker_name'] ?><br><br>
            成分：<?= $value['component'] ?><br><br>
            ポイント：<?= $value['catch_copy']?><br><br>
          </div>
          <input name="genre" type="hidden" value="<?php $value['id'] ?>">
        </div>
      <?php endforeach ?>
    </div>
    <div class="backToppage">
    <a href="/DrugStore/fe_index.php">
      TOPページに戻る
    </a>
  </div>
  </div>
</body>
</html>
