<?php //関数置き場

function connect_db()
{
  $dsn = 'mysql:host=localhost;dbname=sample1;charset=utf8';
  $username = 'root';
  $password = '';
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];
  return new PDO($dsn, $username, $password, $options);
}


function insert($sql, $arr = [])
{
  $pdo = connect_db();
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arr);
  return $pdo->lastInsertId();
}


function select($sql, $arr = [])
{
  $pdo = connect_db();
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arr);
  return $stmt->fetchAll();
}


function h($string)
{
  return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}

function genre_serch($genreId, $genreName){
  $dbh=connect_db();
  if($genreId != "" OR $genreName != ""){
    // $id = filter_input(INPUT_POST, 'genreid');
    // $name = filter_input(INPUT_POST, 'genrename');

    $sqlFlg = 0;
    if(!empty($genreId) && empty($genreNamee)){   //ジャンルIDのみパターン
      $sqlFlg = 1;
    }elseif(empty($genreId) && !empty($genreName)){ //ジャンル名のみパターン
      $sqlFlg = 2;
    }elseif(isset($genreId,$genreName)){ //両方パターン
      $sqlFlg = 3;
    }

    $query = "SELECT * FROM genre WHERE ";
    if($sqlFlg == 1){
      $query .= ' id = :id';
    }else if($sqlFlg == 2){
      $query .= ' name LIKE :name';
    }
    else if($sqlFlg == 3){
      $query .= ' id = :id AND name LIKE :name';
    }

    $stmt  = $dbh->prepare($query);
    if($genreId) $stmt -> bindValue(':id', $genreId, PDO::PARAM_INT);
    if($genreName) $stmt -> bindValue(':name', '%'.$genreName.'%', PDO::PARAM_STR);
    $stmt->execute();
    $serched=$stmt->fetchAll();
    return $serched;

  }else{
    return false;
  }
}

function genre_new($genre){
  // POSTではないとき何もしない
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return;
  }
  $sql = 'INSERT INTO `genre` (`id`,`name`) VALUES (NULL, :genre) ';
  $arr = [];
  $arr[':genre'] = $genre;
  $pdo = connect_db();
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arr);
  return $pdo->lastInsertId();
}

function genre_edit($name,$id){
  //POSTがないなら何もしない
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return false;
  }
  // $genre = filter_input(INPUT_POST, 'genre');
  // $id = filter_input(INPUT_POST, 'id');
  $dbh=connect_db();
  $sql2 = "UPDATE genre SET name = :name WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':name' => "$name", ':id' => "$id");
  $stmt->execute($params);
}

function genre_delete($id){
  // POSTではないとき何もしない
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return;
  }
  $dbh = connect_db();
  $sql2 = "DELETE FROM genre WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':id' => "$id");
  $stmt->execute($params);
}

function maker_serch($id, $name){
  $dbh=connect_db();
  if($id != "" OR $name != ""){
    $sqlFlg = 0;
    if(!empty($id) && empty($name)){   //IDのみパターン
      $sqlFlg = 1;
    }elseif(empty($id) && !empty($name)){ //名のみパターン
      $sqlFlg = 2;
    }elseif(isset($id,$name)){ //両方パターン
      $sqlFlg = 3;
    }

    $query = "SELECT * FROM maker WHERE ";
    if($sqlFlg == 1){
      $query .= ' id = :id';
    }else if($sqlFlg == 2){
      $query .= ' name LIKE :name';
    }
    else if($sqlFlg == 3){
      $query .= ' id = :id AND name LIKE :name';
    }

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

function maker_new($maker){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return false;
  }
  $sql = 'INSERT INTO `maker` (`id`,`name`) VALUES (NULL, :maker) ';
  $arr = [];
  $arr[':maker'] = $maker;
  $pdo = connect_db();
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arr);
  return $pdo->lastInsertId();
}

function maker_edit($makername,$makerid){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return false;
  }
  $dbh=connect_db();
  $sql2 = "UPDATE maker SET name = :name WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':name' => "$makername", ':id' => "$makerid");
  $stmt->execute($params);
}

function maker_delete($id){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return;
  }
  $dbh = connect_db();
  $sql2 = "DELETE FROM maker WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':id' => "$id");
  $stmt->execute($params);
}

function brand_serch($id, $name,$brandmaker){
  $dbh=connect_db();
  if($id != "" OR $name != "" OR $brandmaker != ""){
    $sqlFlg = 0;
    if(!empty($id) && empty($name) && empty($brandmaker)){   //IDのみパターン
      $sqlFlg = 1;
    }elseif(empty($id) && !empty($name) && empty($brandmaker)){ //brand名のみパターン
      $sqlFlg = 2;
    }elseif(empty($id) && empty($name) && !empty($brandmaker)){ //maker名のみパターン
      $sqlFlg = 3;
    }elseif(isset($id,$name) && empty($brandmaker)){ //id&nameパターン
      $sqlFlg = 4;
    }elseif(isset($id,$brandmaker) && empty($name)){ //id&brandmakerパターン
      $sqlFlg = 5;
    }elseif(isset($name,$brandmaker) && empty($id)){ //name&brandmakerパターン
      $sqlFlg = 6;
    }elseif(isset($name,$brandmaker,$id)){ //id&name&brandmakerパターン
      $sqlFlg = 7;
    }

    $query = "SELECT * FROM brand WHERE ";
    if($sqlFlg == 1){
      $query .= ' id = :id';
    }else if($sqlFlg == 2){
      $query .= ' name LIKE :name';
    }else if($sqlFlg == 3){
      $query .= ' maker_id = :brandmaker ';
    }else if($sqlFlg == 4){
      $query .= ' id = :id AND name LIKE :name';
    }else if($sqlFlg == 5){
      $query .= ' id = :id AND maker_id = :brandmaker';
    }else if($sqlFlg == 6){
      $query .= ' name LIKE :name AND maker_id = :brandmaker';
    }else if($sqlFlg == 7){
      $query .= ' name LIKE :name AND name LIKE :name AND maker_id = :brandmaker';
    }

    $stmt  = $dbh->prepare($query);
    if($id) $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
    if($name) $stmt -> bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);
    if($brandmaker) $stmt -> bindValue(':brandmaker', $brandmaker, PDO::PARAM_INT);
    $stmt->execute();
    $serched=$stmt->fetchAll();
    return $serched;

  }else{
    return false;
  }
}

function brand_new($brand,$maker_id){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return false;
  }

  $sql = 'INSERT INTO `brand` (`id`,`name`,`maker_id`) VALUES (NULL, :brand, :maker_id) ';
  $arr = [];
  $arr[':brand'] = $brand;
  $arr[':maker_id'] = $maker_id;
  $pdo = connect_db();
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arr);
  return $pdo->lastInsertId();
}

function brand_delete($id){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return;
  }
  $dbh = connect_db();
  $sql2 = "DELETE FROM brand WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':id' => "$id");
  $stmt->execute($params);
}

function brand_edit($brand,$maker_id,$id){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return false;
  }
  $dbh=connect_db();
  $sql2 = "UPDATE brand SET name = :name,maker_id = :maker_id WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':name' => "$brand", ':maker_id' => "$maker_id", ':id' => "$id");
  $stmt->execute($params);
}

?>
