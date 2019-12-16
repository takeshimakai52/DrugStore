<?php
  require 'common.php';
  $pdo = connect();
  $st = $pdo->query("SELECT * FROM item");
  $item = $st->fetchAll();
  require 'topPage_index.php';
?>
