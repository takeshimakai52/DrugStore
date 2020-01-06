<?php
  session_start();
  require 'common.php';
  $name = filter_input(INPUT_POST, 'itemname');
  $genre = filter_input(INPUT_POST, 'genre');
  $maker = filter_input(INPUT_POST, 'maker');
  $brand = filter_input(INPUT_POST, 'brand');

  echo $name;
  echo $genre;
  echo $maker;
  echo $brand;

  function item_serch($name,$genre,$maker,$brand){
    $dbh=connect_db();
    if($name != "" OR $genre != "" OR $maker != "" OR $brand != ""){ 
      $sqlFlg = 0;
      if(!empty($name) && empty($genre) && empty($maker) && empty($brand)){   //nameのみパターン
        $sqlFlg = 1;
      }elseif(empty($name) && !empty($genre) && empty($maker) && empty($brand)){ //genreのみパターン
        $sqlFlg = 2;
      }elseif(empty($name) && empty($genre) && !empty($maker) && empty($brand)){ //maker名のみパターン
        $sqlFlg = 3;
      }elseif(empty($name) && empty($genre) && empty($maker) && !empty($brand)){ //brandのみパターン
        $sqlFlg = 4;
      }elseif(isset($name,$genre) && empty($maker) && empty($brand)){ //name genreパターン
        $sqlFlg = 5;
      }elseif(isset($name,$genre,$maker) && empty($brand)){ //brand以外パターン
        $sqlFlg = 6;
      }elseif(isset($name,$genre,$maker,$brand)){ //name genre maker brandパターン
        $sqlFlg = 7;
      }elseif(isset($genre,$maker) && empty($name) && empty($brand)){ //genre makerパターン
        $sqlFlg = 8;
      }elseif(isset($genre,$brand) && empty($name) && empty($maker)){ //genre brandパターン
        $sqlFlg = 9;
      }elseif(isset($genre,$maker,$brand) && empty($name)){ //name以外パターン
        $sqlFlg = 10;
      }elseif(isset($maker,$name) && empty($genre) && empty($brand)){ //maker nameパターン
        $sqlFlg = 11;
      }elseif(isset($maker,$brand) && empty($genre) && empty($name)){ //maker brandパターン
        $sqlFlg = 12;
      }elseif(isset($maker,$brand,$name) && empty($genre)){ //genre以外パターン
        $sqlFlg = 13;
      }elseif(isset($brand,$name) && empty($genre) && empty($maker)){ //brand nameパターン
        $sqlFlg = 14;
      }elseif(isset($brand,$name,$genre) && empty($maker)){ //maker以外パターン
        $sqlFlg = 15;
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
  
  
  try{
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST') {
      $res = brand_serch($id,$name,$brandmaker);
      if($res==""){
        $dbh=connect_db();
        $sql = "SELECT * FROM brand";
        $res = $dbh->query($sql);
      }
    }else{
      $dbh=connect_db();
      $sql = "SELECT * FROM brand";
      $res = $dbh->query($sql);
    }

  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
  }

  $_SESSION['searchres'] = $res;
  //header("location:brand.php")

?>