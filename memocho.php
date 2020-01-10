<?php
function genre_serch($genreId, $genreName){
    $dbh=connect_db();
    if($genreId != "" OR $genreName != ""){ 
      $id = filter_input(INPUT_POST, 'genreid');
      $name = filter_input(INPUT_POST, 'genrename');
 
      $sqlFlg = 0;
      if(!empty($id) && empty($name)){   //ジャンルIDのみパターン
        $sqlFlg = 1;
      }elseif(empty($id) && !empty($name)){ //ジャンル名のみパターン
        $sqlFlg = 2;
      }elseif(isset($id,$name)){ //両方パターン
        $sqlFlg = 3;
      }
      
      $query = "SELECT * FROM genre WHERE ";
      if($sqlFlg == 1){
        $query .= ' id = :id';
      }else if($sqlFlg == 2){
        $query .= ' name LIKE :name';
      }
      else if($sqlFlg == 3){
        $query .= ' id = :id AND name LIKE :name';
      }

      $stmt  = $dbh->prepare($query);
      if($id) $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
      if($name) $stmt -> bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);
      $stmt->execute();
      $serched=$stmt->fetchAll();

      // $statement = $dbh->prepare("SELECT * FROM genre WHERE id = '2' ");
      // $sql = "SELECT * FROM genre WHERE id = $id OR name LIKE '%$name%";
      // $res = $dbh->query($sql);
      // $st = $dbh->prepare("SELECT * FROM genre WHERE id = ?");
      // $res = $st->execute(array(2));

      // $query = "SELECT * FROM genre WHERE name like :value OR id = :id";
      // $stmt  = $dbh->prepare($query);
      // $stmt->bindValue(":value", '%'. $name .'%', PDO::PARAM_STR);
      // $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      // $stmt->execute();
      // $serched=$stmt->fetchAll();

      // $stmt = $dbh->query("SELECT * FROM genre WHERE ID='".$_POST["genreid"] ."' OR Name LIKE  '%".$_POST["genrename"]."%')");
      // var_dump($stmt);
      // $statement->bindValue(':id',$_POST["genreid"]);
      // $stmt=$statement->execute();
      
      // foreach($serched as $value){
      //   echo $value['name'];
      //   echo $value['id'];
      // }

      return $serched;
    }else{
      return false;
    }
  }

  function maker_serch(){
    $dbh=connect_db();
    if($_POST["genreid"] != "" OR $_POST["genrename"] != ""){ 
      $id = filter_input(INPUT_POST, 'genreid');
      $name = filter_input(INPUT_POST, 'genrename');
      $query = "SELECT * FROM maker WHERE 1=1";
      if($id) $query .= ' AND id = :id';
      if($name) $query .= ' AND name LIKE :name';
      $stmt  = $dbh->prepare($query);
      if($id) $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
      if($name) $stmt -> bindValue(':name', '%'.$name.'%', PDO::PARAM_STR);
      $stmt->execute();
      $serched=$stmt->fetchAll();
      return $serched;
    }else{
      return;
    }
  }
?>
