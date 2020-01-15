<?php
  session_start();
  require 'common.php';

  // 紐づくメーカー名を取得
  function maker_name($maker_id){
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
  $dbh=connect_db();
  $sql = "SELECT * FROM brand";
  $sql2= "SELECT * FROM maker";
  $res = $dbh->query($sql);
  $makers = $dbh->query($sql2);
  if(isset($_SESSION["searchres"])){
    $res = $_SESSION["searchres"];
  }
  unset($_SESSION['searchres']);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet"type="text/css"  href="kari.css">
		<link rel="stylesheet"type="text/css"  href="genre.css">
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
          　ブランド管理
        </div>
        <div>
        </div>
        <div class="maincontents">

        <form action="brandsearch.php" method="post">
          <div class="serchbox">
            <div class="itemname">
              <div class="itemname_title">
                ブランドNo
              </div>
              <input type="text" name="brandid"　value="">
            </div>
            <div class="genre">
              <div class="genreselect">
                <div class="itemname_title">
                  ブランド名
                </div>
                <input type="text" name="brandname">
              </div>
            </div>
            <div class="genre">
              <div class="genreselect">
                <div class="itemname_title">
                  メーカー名
                </div>
                <select name="brandmaker">
                  <option value="">メーカーを選択してください</option>
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
            <button type="submit" name="itemsearch" class="itemserch">検索</button>
          </div>
        </form>

        <form action="brandnew.php" method="post">
          <div class="serchbox">
            <button type="submit" name="itemsearch" class="itemserch">登録画面へ</button>
          </div>
        </form>

          <div class="itemshow">
            <div class="itemshowbox">
              <div class="itemlabel">
								<div class="labelno">
									No
								</div>
								<div class="labelname">
									ブランド
                </div>
                <div class="labelname">
									メーカー
								</div>
              </div>

<?php
foreach($res as $value):
?>
              <div class="syouhin">
                <div class="syouhinnum">
                  <?= $value['id'] ?>
                </div>
                <div class="syouhinname">
                  <?= $value['name'] ?>
                </div>
                <div class="syouhinname">
                  <?= maker_name($value['maker_id']) ?>
                </div>

                <form action="brandedit.php" method="post">
                  <div class="syouhinbtn1">
                    <input type='hidden' name='editid' value='<?php echo $value["id"]; ?>'>
                    <input type='hidden' name='editname' value='<?php echo $value["name"]; ?>'>
                    <input type='hidden' name='editmaker_id' value='<?php echo $value["maker_id"]; ?>'>
                    <input type="submit" value="編集">
                  </div>
                </form>
                <form action="branddelete.php" method="post">
                  <div class="syouhinbtn">
                    <input type='hidden' name='deleteid' value='<?php echo $value["id"]; ?>'>
                    <input type='hidden' name='deletename' value='<?php echo $value["name"]; ?>'>
                    <input type="submit" value="削除" onclick='return confirm("本当に削除しますか？");'/>
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
