<?php
  session_start();
  require 'common.php';
  $id = filter_input(INPUT_POST, 'brandid');
  $name = filter_input(INPUT_POST, 'brandname');
  $brandmaker = filter_input(INPUT_POST, 'brandmaker');//紐づくメーカーのid
  echo $brandmaker;
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