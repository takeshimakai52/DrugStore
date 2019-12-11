<?php
  require 'common.php';
  function maker_serch(){
    $dbh=connect_db();
    // if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST') {
    if($_POST["genreid"] != "" OR $_POST["genrename"] != ""){ 
      $id = filter_input(INPUT_POST, 'genreid');
      $name = filter_input(INPUT_POST, 'genrename');
      $query = "SELECT * FROM maker WHERE 1=1";
      if($id) $query .= ' AND id = :id';
      if($name) $query .= ' AND name LIKE :name';
      $stmt  = $dbh->prepare($query);
      if($id) $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
      if($name) $stmt -> bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);
      $stmt->execute();
      $serched=$stmt->fetchAll();
      return $serched;

    }else{
      return;
    }
  }


  try{
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST') {
      $res = maker_serch();
    }else{
      $dbh=connect_db();
      $sql = "SELECT * FROM maker";
      $res = $dbh->query($sql);
    }
    // genre_serch();
    // $dbh=connect_db();
    // $sql = "SELECT * FROM genre";
    // $res = $dbh->query($sql);
 
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
		<link rel="stylesheet"type="text/css"  href="genre.css">
    <link rel="stylesheet"type="text/css"  href="normalize.css">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
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
      <div class="sidebar">
        <ul class="menu">
          <li>
            <a href="" class="listmenu">商品一覧</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href=""class="listmenu">商品登録</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href="genre.php" class="listmenu">ジャンル管理</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href="" class="listmenu">メーカー管理</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href="" class="listmenu">ブランド管理</a>
          </li>
          <div class="kasen"></div>
          <li>
            <a href="" class="listmenu">売価管理</a>
          </li>
          <div class="kasen"></div>
        </ul>
      </div>
      <div class="main">
        <div class="maintitle">
          　メーカー管理
        </div>
        <div class="maincontents">
          
        <form action="" method="post">
          <div class="serchbox">
            <div class="itemname">
              <div class="itemname_title">
                メーカーNo
              </div>
              <input type="text" name="genreid"　value="">
            </div>
            <div class="genre">
              <div class="genreselect">
                <div class="itemname_title">
                  メーカー名
                </div>
                <input type="text" name="genrename">
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

          <!-- <form action="genrenew.php" method="get"></form>
            <div class="serchbox">
              <button type="submit" name="itemsearch" class="itemserch">登録画面へ</button>
            </div>
          </form> -->
          
          <div class="itemshow">
            <div class="itemshowbox">
              <div class="itemlabel">
								<div class="labelno">
									No
								</div>
								<div class="labelname">
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