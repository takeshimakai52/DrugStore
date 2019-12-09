<?php
  require 'common.php';

  try{
    $dbh=connect_db();
    $sql = "SELECT * FROM genre";
    $res = $dbh->query($sql);
    // foreach( $res as $value ) {
    //   echo "$value[name]<br>";
    //   echo "$value[id]<br>";
    // }
    // foreach( $res as $value ){

      
    //   echo "$value[id]";
    //   echo "$value[name]";
    // }
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }

//  foreach( $res as $value ){
      
//   echo "$value[id]";
//   echo "$value[name]";
//  }

  // try{
  //   $dbh = new PDO("mysql:localhost; dbname=sample; charset=utf8", 'root', 'password');
  //   $sql = "SELECT * FROM genre";

  //   // SQL実行
  //   $res = $dbh->query($sql);
  
  //   // 取得したデータを出力
  //   foreach( $res as $value ) {
  //     echo "$value[name]<br>";
  //   }
  
  // } catch(PDOException $e) {
  //   echo $e->getMessage();
  //   die();
  // }
  

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
            <a href="" class="listmenu">ジャンル管理</a>
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
          　ジャンル管理
        </div>
        <div class="maincontents">
          <form action="" method="get">
            <div class="serchbox">
              <div class="itemname">
                <div class="itemname_title">
                  ジャンルNo
                </div>
                <input type="text" name="itemname">
              </div>
              <div class="genre">
                <div class="genreselect">
                  <div class="itemname_title">
                    ジャンル名
                  </div>
                  <input type="text" name="itemname">
                </div>
              </div>
              <button type="submit" name="itemsearch" class="itemserch">検索</button>
            </div>
          </form>
          <form action="genrenew.php" method="post">
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
									ジャンル名
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
                
                <form action="" method="GET">
                  <div class="syouhinbtn1">
                      <input type="submit" value="編集">
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