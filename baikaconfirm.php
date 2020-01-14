<?php
  require 'common.php';
  $id = filter_input(INPUT_POST, 'item_id_to_baika');
  $saleprice = filter_input(INPUT_POST, 'saleprice');
  $fromdate = filter_input(INPUT_POST, 'fromdate');
  $todate = filter_input(INPUT_POST, 'todate');

  echo $id."<br>";
  echo $saleprice."<br>";
  echo $fromdate."<br>";
  echo $todate."<br>";

  function baika_new($id,$saleprice,$fromdate,$todate){
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
        return false;
    }
    $sql = 
    'INSERT INTO `saleprice` (`id`,`item_id`,`saleprice`,`fromdate`,`todate`) 
    VALUES (NULL, :item_id, :saleprice,:fromdate,:todate)';
    $arr = [];
    $arr[':item_id'] = $id;
    $arr[':saleprice'] = $saleprice;
    $arr[':fromdate'] = $fromdate;
    $arr[':todate'] = $todate;
    $pdo = connect_db();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);
    return $pdo->lastInsertId();
  }

  try{
	  baika_new($id,$saleprice,$fromdate,$todate);
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }

 header("location:baika.php");
?>