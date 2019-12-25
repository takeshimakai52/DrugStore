<?php
  require 'common.php';
  $name = filter_input(INPUT_POST, 'name');
  $price = filter_input(INPUT_POST, 'price');
  $itemgenre = filter_input(INPUT_POST, 'itemgenre');
  $itemmaker = filter_input(INPUT_POST, 'itemmaker');
  $itembrand = filter_input(INPUT_POST, 'itembrand');
  $component = filter_input(INPUT_POST, 'seibun');
  $catch_copy = filter_input(INPUT_POST, 'catch_copy');
  $upfile = $_FILES['image'];
  
  function item_new($name,$price,$itemgenre,$itemmaker,$itembrand,$component,$catch_copy,$upfile){    
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

    if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') !== 'POST') {
      return false;
  }
    $sql = 
    'INSERT INTO `item` (`id`,`name`,`genre_id`,`brand_id`,`maker_id`,`price`,`component`,`catch_copy`,`filepath`)
     VALUES (NULL, :name, :genre_id, :brand_id, :maker_id, :price, :component, :catch_copy, :filepath) ';
    $arr = [];
    $arr[':name'] = $name;
    $arr[':genre_id'] = $itemgenre;
    $arr[':brand_id'] = $itembrand;
    $arr[':maker_id'] = $itemmaker;
    $arr[':price'] = $price;
    $arr[':component'] = $component;
    $arr[':catch_copy'] = $catch_copy;
    $arr[':filepath'] = $destination;
    $pdo = connect_db();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);
    return $pdo->lastInsertId();
  }

  try{
		item_new($name,$price,$itemgenre,$itemmaker,$itembrand,$component,$catch_copy,$upfile);	
  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
 }

 header("location:item.php");


?>