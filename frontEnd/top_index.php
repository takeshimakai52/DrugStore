<?php
  require 'common.php';

  try{
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST') {
      $res = maker_serch($_POST["genreid"],$_POST["genrename"]);
      if($res==""){
        $dbh=connect_db();
        $sql = "SELECT * FROM maker";
        $res = $dbh->query($sql);
      }
    }else{
      $dbh=connect_db();
      $sql = "SELECT * FROM maker";
      $res = $dbh->query($sql);
    }
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();

 }

?>

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
    <?php
foreach($res as $value):
?>
<div class="leftCategory_sideMenu">
  <span class="genreTitle_sideMenu">
    ジャンル
  </span>
  <div class="">
  </div>
  <span class="manufactureTitle_sideMenu">
    メーカー
  </span>
  <span class="brandTitle_sideMenu">
    ブランド
  </span>
</div>
<?php
endforeach
?>

<!-- ここから参考
  <div class="syouhin">
    <div class="syouhinnum">
      <?= $value['id'] ?>
    </div>
    <div class="syouhinname">
      <?= $value['name'] ?>
    </div>

    <form action="makeredit.php" method="post">
      <div class="syouhinbtn1">
        <input type='hidden' name='editid' value='<?php echo $value["id"]; ?>'>
        <input type='hidden' name='editname' value='<?php echo $value["name"]; ?>'>
        <input type="submit" value="編集">
      </div>
    </form>
    <form action="makerdelete.php" method="post">
      <div class="syouhinbtn">
        <input type='hidden' name='deleteid' value='<?php echo $value["id"]; ?>'>
        <input type='hidden' name='deletename' value='<?php echo $value["name"]; ?>'>
        <input type="submit" value="削除">
      </div>
    </form>
  </div>
  ここまで参考 -->

</body>
</html>
