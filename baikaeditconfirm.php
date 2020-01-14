<?php
  require 'common.php';
  $id = filter_input(INPUT_POST, 'baikaid');
  $itemid = filter_input(INPUT_POST, 'item_id_to_baika');
  $saleprice = filter_input(INPUT_POST, 'saleprice');
  $fromdate = filter_input(INPUT_POST, 'fromdate');
  $todate = filter_input(INPUT_POST, 'todate');

  echo $id."<br>";
  echo $itemid."<br>";
  echo $saleprice."<br>";
  echo $fromdate."<br>";
  echo $todate."<br>";
  
  function saleprice_edit($id,$itemid,$saleprice,$fromdate,$todate){
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
        return false;
    }
    $dbh=connect_db();
    $sql = 
    "UPDATE saleprice SET item_id=:item_id,saleprice=:saleprice,fromdate=:fromdate,todate=:todate WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $params = 
    array(':item_id' => "$itemid", ':saleprice' => "$saleprice", ':fromdate' => "$fromdate",':todate' => "$todate",
     ':id' => "$id");
    $stmt->execute($params);
  }

  try{
	  saleprice_edit($id,$itemid,$saleprice,$fromdate,$todate);
		
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }

 header("location:baika.php");
?>