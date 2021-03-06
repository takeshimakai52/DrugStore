<?php
  session_start();
  require 'common.php';
  $dbh=connect_db();
  $sql = "SELECT * FROM maker";
  $res = $dbh->query($sql);
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
          　メーカー管理
        </div>
        <div class="maincontents">

        <form action="makersearch.php" method="post">
          <div class="serchbox">
            <div class="itemname">
              <div class="itemname_title">
                メーカーNo
              </div>
              <input type="text" name="makerid"　value="">
            </div>
            <div class="genre">
              <div class="genreselect">
                <div class="itemname_title">
                  メーカー名
                </div>
                <input type="text" name="makername">
              </div>
            </div>
            <button type="submit" name="itemsearch" class="itemserch">検索</button>
          </div>
        </form>

        <form action="makernew.php" method="post">
          <div class="serchbox">
            <button type="submit" name="itemsearch" class="itemserch">登録画面へ</button>
          </div>
        </form>

          <div class="itemshow">
            <div class="itemshowbox">
              <div class="itemlabel">
								<div class="itemnum">
									No
								</div>
								<div class="itemnum">
									メーカー名
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
