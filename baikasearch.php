<?php
  session_start();
  require 'common.php';
  $name = filter_input(INPUT_POST, 'itemname');
  $genre = filter_input(INPUT_POST, 'genre');
  $maker = filter_input(INPUT_POST, 'maker');
  $brand = filter_input(INPUT_POST, 'brand');

  // echo $name."<br>";
  // echo "genre".$genre."<br>";
  // echo "maker".$maker."<br>";
  // echo "brand".$brand."<br>";

  function item_serch($name,$genre,$maker,$brand){
    $dbh=connect_db();
    if($name != "" OR $genre != "" OR $maker != "" OR $brand != ""){ 
      $sqlFlg = 0;
      if(!empty($name) && empty($genre) && empty($maker) && empty($brand)){   //nameのみパターン
        $sqlFlg = 1;
      }elseif(empty($name) && !empty($genre) && empty($maker) && empty($brand)){ //genreのみパターン
        $sqlFlg = 2;
      }elseif(empty($name) && empty($genre) && !empty($maker) && empty($brand)){ //maker名のみパターン
        $sqlFlg = 3;
      }elseif(empty($name) && empty($genre) && empty($maker) && !empty($brand)){ //brandのみパターン
        $sqlFlg = 4;
      }elseif(isset($name,$genre) && empty($maker) && empty($brand)){ //name genreパターン
        $sqlFlg = 5;
      }elseif(!empty($name) && !empty($genre) && !empty($maker) && empty($brand)){ //brand以外パターン
        $sqlFlg = 6;
      }elseif(!empty($name) && !empty($genre) && !empty($maker) && !empty($brand)){ //name genre maker brandパターン
        $sqlFlg = 7;
      }elseif(isset($genre,$maker) && empty($name) && empty($brand)){ //genre makerパターン
        $sqlFlg = 8;
      }elseif(isset($genre,$brand) && empty($name) && empty($maker)){ //genre brandパターン
        $sqlFlg = 9;
      }elseif(empty($name) && !empty($genre) && !empty($maker) && !empty($brand)){ //name以外パターン
        $sqlFlg = 10;
      }elseif(isset($maker,$name) && empty($genre) && empty($brand)){ //maker nameパターン
        $sqlFlg = 11;
      }elseif(isset($maker,$brand) && empty($genre) && empty($name)){ //maker brandパターン
        $sqlFlg = 12;
      }elseif(isset($maker,$brand,$name) && empty($genre)){ //genre以外パターン
        $sqlFlg = 13;
      }elseif(isset($brand,$name) && empty($genre) && empty($maker)){ //brand nameパターン
        $sqlFlg = 14;
      }elseif(isset($brand,$name,$genre) && empty($maker)){ //maker以外パターン
        $sqlFlg = 15;
      }
        
      $query = "SELECT * FROM item WHERE ";
      if($sqlFlg == 1){
        $query .= ' name LIKE :name';
      }else if($sqlFlg == 2){
        $query .= ' genre_id = :genre ';
      }else if($sqlFlg == 3){
        $query .= ' maker_id = :maker ';
      }else if($sqlFlg == 4){
        $query .= ' brand_id = :brand ';
      }else if($sqlFlg == 5){
        $query .= ' name LIKE :name AND genre_id = :genre';
      }else if($sqlFlg == 6){
        $query .= ' name LIKE :name AND genre_id = :genre AND maker_id = :maker';
      }else if($sqlFlg == 7){
        $query .= ' name LIKE :name AND genre_id = :genre AND maker_id = :maker AND brand_id = :brand';
      }else if($sqlFlg == 8){
        $query .= ' genre_id = :genre AND maker_id = :maker';
      }else if($sqlFlg == 9){
        $query .= ' genre_id = :genre AND brand_id = :brand';
      }else if($sqlFlg == 10){
        $query .= 'genre_id = :genre AND maker_id = :maker AND brand_id = :brand';
      }else if($sqlFlg == 11){
        $query .= ' name LIKE :name AND maker_id = :maker';
      }else if($sqlFlg == 12){
        $query .= ' maker_id = :maker AND brand_id = :brand ';
      }else if($sqlFlg == 13){
        $query .= ' name LIKE :name AND maker_id = :maker AND brand_id = :brand';
      }else if($sqlFlg == 14){
        $query .= ' name LIKE :name AND brand_id = :brand';
      }else if($sqlFlg == 15){
        $query .= ' name LIKE :name AND genre_id = :genre AND brand_id = :brand';
      }
  
      $stmt  = $dbh->prepare($query);
      if($name) $stmt -> bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);
      if($genre) $stmt -> bindValue(':genre',$genre, PDO::PARAM_INT);
      if($maker) $stmt -> bindValue(':maker', $maker, PDO::PARAM_INT);
      if($brand) $stmt -> bindValue(':brand', $brand, PDO::PARAM_INT);
      // echo $sqlFlg;
      // echo $query;
      $stmt->execute();
      $serched=$stmt->fetchAll();
      return $serched;
  
    }else{
      return false;
    }
  }
    
  try{
    if(filter_input(INPUT_SERVER, 'REQUEST_METHOD') == 'POST') {
      $searched_items = item_serch($name,$genre,$maker,$brand);
      $itemids=[];
      //var_dump($searched_items);
      // $saleprice_itemids=[];
      if($searched_items==""){
        $dbh=connect_db();
        $sql = "SELECT * FROM saleprice";
        $res = $dbh->query($sql);
      }else{
        $res=[];
        $dbh=connect_db();
        $sql = "SELECT * FROM saleprice";
        $baikas = $dbh->query($sql);
        // var_dump($baikas);
        // foreach($baikas as $value){
        //  echo $value["id"];
        // }
        foreach($searched_items as $value){
          array_push($itemids,$value["id"]);
        }
        //var_dump($itemids);
        //echo count($itemids);

        for($i = 0; $i < count($itemids); $i++){
          echo $i."回目".$itemids[$i]."<br>";
          $baikas = $dbh->query($sql);
          foreach($baikas as $value){
            echo "cheack"."<br>";
            //echo $itemids[$i];
            //echo $value["item_id"];
            if($value["item_id"]==$itemids[$i]){
              echo "合致したsalepriceのId".$value["id"]."<br>";
              echo "合致したsalepriceのitem_id".$value["item_id"]."<br>";
              array_push($res,$value);
            }else{
              echo "違う!"."<br>";
            }
          }
        }

      }
    }else{
      $dbh=connect_db();
      $sql = "SELECT * FROM saleprice";
      $res = $dbh->query($sql);
    }

  }catch(PDOException $e) {
    echo $e->getMessage();
    die();
  }

  $_SESSION['item_searchres'] = $res;
  // var_dump($res);
  foreach($res as $value){
    echo $value["id"];
  }

  header("location:baika.php")

?>