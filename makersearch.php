<?php
  session_start();
  require 'common.php';
  $id = filter_input(INPUT_POST, 'makerid');
  $name = filter_input(INPUT_POST, 'makername');
  try{
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST') {
      $res = maker_serch($id,$name);
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
  var_dump($res);
  foreach($res as $val){
    echo $val["name"];
  }

  $_SESSION['searchres'] = $res;
  header("location:maker.php")

?>