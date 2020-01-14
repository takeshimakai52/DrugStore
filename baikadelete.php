<?php
  require 'common.php';
  $id = filter_input(INPUT_POST, 'delete_saleprice_id');
  
  echo $id;
  
  function baika_delete($id){
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
        return;
    }
    $dbh = connect_db();
    $sql = "DELETE FROM saleprice WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':id' => "$id");
    $stmt->execute($params);
  }

  try{ 
		baika_delete($id);
		
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
  }
  header("location:baika.php");
?>