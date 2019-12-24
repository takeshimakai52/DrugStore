<?php
  session_start();
  require 'common.php';
  $id = filter_input(INPUT_POST, 'genreid');
  $name = filter_input(INPUT_POST, 'genrename');
  try{
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST') {
      $res = genre_serch($id,$name);
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

  $_SESSION['searchres'] = $res;
  header("location:genre.php")

?>