<?php
  require 'common.php';
  $id = filter_input(INPUT_POST, 'deleteid');
  
  echo $id;
  
  function item_delete($id){
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
        return;
    }
    $dbh = connect_db();
    $sql = "DELETE FROM item WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':id' => "$id");
    $stmt->execute($params);
  }

  try{ 
		item_delete($id);
		
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
  }
  header("location:item.php");
?>