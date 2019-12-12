<?php
require 'frontEnd_common.php';
$pdo = connect();
$st = $pdo->query("SELECT * FROM goods");
$goods = $st->fetchAll();
require 'topPege_index.php';
?>
