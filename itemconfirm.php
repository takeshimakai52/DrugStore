<?php
  require 'common.php';

  function item_new($brand,$maker_id){
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
  
  $name = filter_input(INPUT_POST, 'name');
  $price = filter_input(INPUT_POST, 'price');
  $itemgenre = filter_input(INPUT_POST, 'itemgenre');
  try{
		item_new($genre);
		
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }


?>