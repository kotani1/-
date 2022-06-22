<?php
session_start();
require "db.php";
$err = [];
//email取得
if (!$email = h(filter_input(INPUT_POST, 'email'))) {
  $err['email'] = "メールアドレスを入力してください";
}else if (!$password = filter_input(INPUT_POST, 'password')) {
  $err['password'] = "パスワードを入力してください";
  header("Location: login.php");
}else {

  //emailが一致するユーザを検索
  $pdo = pdoConnect();
  $sql = "SELECT * FROM member WHERE email = :email";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':email', $email);
  $stmt->execute();


  if (!$result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $err['email_check'] = "メールアドレスが違います";
  }else {
      if(password_verify($password, $result['password'])) {
        echo "ログイン認証に成功しました";
      } else {
        $err['password_check'] = "パスワードが違います";
      }
  }
}
$_SESSION = $err;
if(count($err)>0){
  header("Location: login.php");
  exit();
}
$_SESSION['name'] = h($result['name']);
header("Location: index.php");
