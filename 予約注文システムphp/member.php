<?php
session_start();
$err = $_SESSION;
$_SESSION  = array();
session_destroy();
$token_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($token_byte);
$_SESSION['token'] = $csrf_token;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>

<body>
  <form action="memberDb.php" method="POST">
    <p>お名前</p>
      <input type="text" name="name">
        <?php if (isset($err['name'])) : ?>
          <p class="err"><?php echo $err['name'] ?></p>
        <?php endif; ?>
    <p>電話番号</p>
      <input type="text" name="phone">
        <?php if (isset($err['phone'])) : ?>
          <p class="err"><?php echo $err['phone'] ?></p>
        <?php endif; ?>
    <p>メールアドレス</p>
      <input type="email" name="email">
        <?php if (isset($err['email'])) : ?>
          <p class="err"><?php echo $err['email'] ?></p>
        <?php endif; ?>
        <?php if (isset($err['existence'])) : ?>
          <p class="err"><?php echo $err['existence'] ?></p>
        <?php endif; ?>
    <p>パスワード</p>
      <input type="password" name="password">
      <?php if (isset($err['password'])) : ?>
        <p class="err"><?php echo $err['password'] ?></p>
      <?php endif; ?>
    <p>パスワード確認</p>
      <input type="password" name="password_conf">
      <?php if (isset($err['password_conf'])) : ?>
        <p class="err"><?php echo $err['password_conf'] ?></p>
      <?php endif; ?>
      <?php if (isset($err['not_password'])) : ?>
        <p><?php echo $err['not_password'] ?></p>
      <?php endif; ?>
    <br>
    <input type="hidden" value="<?php echo $csrf_token; ?>">
    <input type="submit" value="登録する">
  </form>
  <style>
    .err {
      color: red;
    }
  </style>
</body>

</html>
