<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <title>reservesystem</title>
</head>

<body>
  <div class="right">
    <?php if (isset($_SESSION['name'])) { ?>
      <span id="loginName"><?php echo $_SESSION['name'] . 'さんようこそ' ?></span>
        <form action="logout.php">
          <input type="submit" value="ログアウト">
        </form>
      <?php } else { ?>
        <a href="member.php">会員登録</a>
        <a href="login.php">ログイン </a><br>
      <?php } ?>
  </div>
  <h2 class="center">予約注文システム</h2>
  <p class="senn">&emsp;</p>
  <ul>

    <li><a href="menu.php">メニュー</a></li>
    <li> <a href="orderHistory.php"> 注文履歴</a></li>
  </ul>
