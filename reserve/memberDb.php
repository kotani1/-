<?php
session_start();
require "db.php";
if (!isset($_POST['token']) && ($_POST['csrf_token'] !== $_SESSION['token'])) {
  echo '不正なリクエストへの処理';
  exit();
}

$err = [];
if (!$name = filter_input(INPUT_POST, 'name')) {
  $err['name'] = "お名前を入力してください";
}
if (!$phone = filter_input(INPUT_POST, 'phone')) {
  $err['phone'] = "電話番号を入力してください";
}
if (!$email = filter_input(INPUT_POST, 'email')) {
  $err['email'] = "メールアドレスを入力してください";
}
if (!$password = filter_input(INPUT_POST, 'password')) {
  $err['password'] = "パスワードを入力してください";
}
if (!$password_conf = filter_input(INPUT_POST, 'password_conf')) {
  $err['password_conf'] = "パスワード確認を入力してください";
}
if ($password !== $password_conf) {
  $err['not_password'] = "パスワードが一致してません";
}

if ((count($err) > 0)) {
  $_SESSION = $err;
  header("Location: member.php");
  exit();
}

$pdo = pdoConnect();

//emailが一致するユーザを検索
$sql = "SELECT * FROM member WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->execute();
if (!$result = $stmt->fetch(PDO::FETCH_ASSOC)){
  $password = password_hash($password, PASSWORD_DEFAULT);

  //登録処理
  $pdo = pdoConnect();
  $sql = "INSERT INTO member(name,phone,email,password) VALUES(:name, :phone,:email,:password)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':phone', $phone,);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':password', $password);
  $stmt->execute();
} else {
  $err['existence'] = 'このメールアドレスは既に存在します。';
  $_SESSION = $err;
  header("Location: member.php");
  exit();
}
$_SESSION['name'] = $name;
?>
<p>登録完了しました</p>
<p><a href="index.php">ホームページに戻る</a></p>
