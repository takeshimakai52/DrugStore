<?php
  require 'common.php';
  $id = filter_input(INPUT_POST, 'edit_saleprice_id');
  $todate = new DateTime('now');
  $enddate= $todate->format('Y-m-d');

  echo $enddate."<br>";

  
  function saleprice_end($id,$todate){
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
        return false;
    }
    $dbh=connect_db();
    $sql = 
    "UPDATE saleprice SET todate=:todate WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':todate' => "$todate",':id' => "$id");
    $stmt->execute($params);
  }

  try{
	  saleprice_end($id,$enddate);
		
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }

 header("location:baika.php");
?>