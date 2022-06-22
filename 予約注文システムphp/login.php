<?php
session_start();
$err = $_SESSION;
$_SESSION = array();
session_destroy();
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
  <form action="loginDb.php" method="POST">
    <p>メールアドレス</p>
    <input type="email" name="email">
    <?php if (isset($err['email'])) : ?>
      <p class="err"><?php echo $err['email'] ?></p>
    <?php endif; ?>
    <?php if (isset($err['email_check'])) : ?>
      <p class="err"><?php echo $err['email_check'] ?></p>
    <?php endif; ?>
    <p>パスワード</p>
    <input type="password" name="password"><br>
    <input type="submit" value="ログイン">
    <?php if (isset($err['password'])) : ?>
      <p class="err"><?php echo $err['password'] ?></p>
    <?php endif; ?>
    <?php if (isset($err['password_check'])) : ?>
      <p class="err"><?php echo $err['password_check'] ?></p>
    <?php endif; ?>
  </form>
  <style>
    .err{
      color: red;
    }
  </style>
</body>
</html>
