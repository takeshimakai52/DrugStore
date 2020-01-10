<?php
  require 'common.php';
  $id = filter_input(INPUT_POST, 'id');
  $name = filter_input(INPUT_POST, 'name');
  $price = filter_input(INPUT_POST, 'price');
  $itemgenre = filter_input(INPUT_POST, 'itemgenre');
  $itemmaker = filter_input(INPUT_POST, 'itemmaker');
  $itembrand = filter_input(INPUT_POST, 'itembrand');
  $component = filter_input(INPUT_POST, 'seibun');
  $catch_copy = filter_input(INPUT_POST, 'catch_copy');
  $oldpath = filter_input(INPUT_POST, 'oldpath');
  $upfile = $_FILES['image'];
  $destination="";

  echo $id."<br>";
  echo $name."<br>";
  echo $price."<br>";
  echo $itemgenre."<br>";
  echo $itemmaker."<br>";
  echo $itembrand."<br>";
  echo $component."<br>";
  echo $catch_copy."<br>";
  echo $oldpath."<br>";
  var_dump($upfile)."<br>";
  $tmp_name = $upfile['tmp_name'];
  if(!empty($tmp_name)){
    echo "<br>"."空じゃないよ！！！！";
    if ($upfile['error'] > 0) {
      throw new Exception('ファイルアップロードに失敗しました。');
    }
    $tmp_name = $upfile['tmp_name'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimetype = finfo_file($finfo, $tmp_name);
    $allowed_types = [
      'jpg' => 'image/jpeg'
      , 'png' => 'image/png'
      , 'gif' => 'image/gif'
    ];
    if (!in_array($mimetype, $allowed_types)) {
      throw new Exception('許可されていないファイルタイプです。');
    }
    $filename = sha1_file($tmp_name);
    $ext = array_search($mimetype, $allowed_types);
    $destination = sprintf('%s/%s.%s'
        , 'upfiles'
        , $filename
        , $ext
    );
    if (!move_uploaded_file($tmp_name, $destination)) {
      throw new Exception('ファイルの保存に失敗しました。');
    }
  }else{
    echo  "<br>"."空だよ";
  }
  if($destination==null){
    $filepath=$oldpath;
  }else{
    $filepath=$destination;
    unlink($oldpath);
  }

  echo "filepath".$filepath;
  
  function item_edit($id,$name,$itemgenre,$itemmaker,$itembrand,$price,$component,$catch_copy,$filepath){
    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
        return false;
    }
    $dbh=connect_db();
    $sql = 
    "UPDATE item SET name = :name,genre_id=:genre_id,maker_id=:maker_id,brand_id=:brand_id,price=:price,component=:component,catch_copy=:catch_copy,filepath=:filepath WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $params = 
    array(':name' => "$name", ':genre_id' => "$itemgenre", ':maker_id' => "$itemmaker",':brand_id' => "$itembrand",
     ':id' => "$id",':price' => "$price",':component' => "$component",':catch_copy' => "$catch_copy",':filepath' => "$filepath",);
    $stmt->execute($params);
  }

  try{
	  item_edit($id,$name,$itemgenre,$itemmaker,$itembrand,$price,$component,$catch_copy,$filepath);
		
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }

 header("location:item.php");
?>