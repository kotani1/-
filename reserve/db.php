<?php

function h($str){
  return htmlspecialchars($str);
}

function pdoConnect(){
  $dsn = 'mysql:dbname=test;host=localhost;charset=utf8mb4';
  $user = 'root';
  $password = '';
  global $pdo;
  try {
      $pdo = new PDO($dsn, $user, $password);
  } catch (PDOException $e) {
    print('Error:' . $e->getMessage());
    die();
  }
  return $pdo;
}
