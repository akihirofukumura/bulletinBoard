<?php
  try {
    $db = new PDO ('mysql:dbname = bulletinBoard;host=127.0.0.1; charset=utf8','root','');
  } catch (PDOException $e) {
    echo "接続エラー". $e -> getMessage;
  }
?>