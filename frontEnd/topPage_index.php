<!DOCTYPE html>
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
  <?php foreach($item as $i) { ?>
    <div class="sideMenu">
      <h2>
        ジャンル
      </h2>
      <ul class="genre_sideMenu">
        <li>
          <?php echo $i['genre'] ?>
        </li>
      </ul>
      <h2>メーカー</h2>
      <ul class="manufacturer_sideMenu">
        <li>
          <?php echo $i['manufacturer'] ?>
        </li>
      </ul>
      <h2>ブランド</h2>
      <ul class="brand_sideMenu">
        <li>
          <?php echo $i['brand'] ?>
        </li>
      </ul>
    </div>
    <div class="productList">
      <h1>
        商品一覧
      </h1>
      <span class="productImage">
        <?php echo $i['image'] ?>
      </span>
      <span class="productName">
        <?php echo $i['name'] ?>
      </span>
      <span class="productPrice">
        <?php echo $i['price'] ?>
      </span>
      <span class="productGenre">
        <?php echo $i['genre'] ?>
      </span>
      <span class="productManufacturer">
        <?php echo $i['manufacturer'] ?>
      </span>
      <span class="productBrand">
        <?php echo $i['brand'] ?>
      </span>
    </div>
  </body>
</html>
