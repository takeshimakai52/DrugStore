<?php
  session_start();
  require 'common.php';
  $id = filter_input(INPUT_POST, 'brandid');
  $name = filter_input(INPUT_POST, 'brandname');
  $brandmaker = filter_input(INPUT_POST, 'brandmaker');//紐づくメーカーのid

  echo $brandmaker;

  
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
  header("location:brand.php")

?>