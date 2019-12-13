<?php //関数置き場

function connect_db()
{
  $dsn = 'mysql:host=localhost;dbname=sample;charset=utf8';
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
    $id = filter_input(INPUT_POST, 'genreid');
    $name = filter_input(INPUT_POST, 'genrename');

    $sqlFlg = 0;
    if(!empty($id) && empty($name)){   //ジャンルIDのみパターン
      $sqlFlg = 1;
    }elseif(empty($id) && !empty($name)){ //ジャンル名のみパターン
      $sqlFlg = 2;
    }elseif(isset($id,$name)){ //両方パターン
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
    if($id) $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
    if($name) $stmt -> bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);
    $stmt->execute();
    $serched=$stmt->fetchAll();
    return $serched;

  }else{
    return false;
  }
}

function genre_new(){
  // POSTではないとき何もしない
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return;
  }
  $genre = filter_input(INPUT_POST, 'genre');
  $sql = 'INSERT INTO `genre` (`id`,`name`) VALUES (NULL, :genre) ';
  $arr = [];
  $arr[':genre'] = $genre;
  $pdo = connect_db();
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arr);
  return $pdo->lastInsertId();
}

function genre_edit(){
  //POSTがないなら何もしない
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return false;
  }
  $genre = filter_input(INPUT_POST, 'genre');
  $id = filter_input(INPUT_POST, 'id');
  $dbh=connect_db();
  $sql2 = "UPDATE genre SET name = :name WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':name' => "$genre", ':id' => "$id");
  $stmt->execute($params);
}

function genre_delete(){
  // POSTではないとき何もしない
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return;
  }
  $id = filter_input(INPUT_POST, 'deleteid');
  $dbh = connect_db();
  $sql2 = "DELETE FROM genre WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':id' => "$id");
  $stmt->execute($params);
}

function maker_serch($Id, $Name){
  $dbh=connect_db();
  if($Id != "" OR $Name != ""){ 
    $id = filter_input(INPUT_POST, 'genreid');
    $name = filter_input(INPUT_POST, 'genrename');
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

function maker_new(){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return false;
  }
  $genre = filter_input(INPUT_POST, 'genre');
  $sql = 'INSERT INTO `maker` (`id`,`name`) VALUES (NULL, :genre) ';
  $arr = [];
  $arr[':genre'] = $genre;
  $pdo = connect_db();
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arr);
  return $pdo->lastInsertId();
}

function maker_edit(){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return false;
  }

  $genre = filter_input(INPUT_POST, 'genre');
  $id = filter_input(INPUT_POST, 'id');
  $dbh=connect_db();
  $sql2 = "UPDATE maker SET name = :name WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':name' => "$genre", ':id' => "$id");
  $stmt->execute($params);
}

function maker_delete(){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return;
  }
  $id = filter_input(INPUT_POST, 'deleteid');
  $dbh = connect_db();
  $sql2 = "DELETE FROM maker WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':id' => "$id");
  $stmt->execute($params);
}

function brand_new(){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return false;
  }
  $genre = filter_input(INPUT_POST, 'genre');
  $maker_id = filter_input(INPUT_POST, 'maker_id');
  $sql = 'INSERT INTO `brand` (`id`,`name`,`maker_id`) VALUES (NULL, :genre, :maker_id) ';
  $arr = [];
  $arr[':genre'] = $genre;
  $arr[':maker_id'] = $maker_id;
  $pdo = connect_db();
  $stmt = $pdo->prepare($sql);
  $stmt->execute($arr);
  return $pdo->lastInsertId();
}

function brand_delete(){
  if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return;
  }
  $id = filter_input(INPUT_POST, 'deleteid');
  $dbh = connect_db();
  $sql2 = "DELETE FROM brand WHERE id = :id";
  $stmt = $dbh->prepare($sql2);
  $params = array(':id' => "$id");
  $stmt->execute($params);
}

?>