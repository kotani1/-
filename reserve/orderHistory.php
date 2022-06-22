<?php
session_start();
$total = 0;
date_default_timezone_set('Asia/Tokyo');
$date =  date('Y年n月j日G時i分');
if (isset($_POST['complete'])) {
  if(isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']){
    echo '注文が完了しました' . "<br><a href='index.php'>ホームページに戻る</a>";
  }else{
    echo '不正なリクエスト<a href="index.php">ホームページに戻る</a>';
    exit();
  }
  if (isset($_SESSION['date'])) {
    $_SESSION['date'] += [count($_SESSION['date']) => $date];
    $_SESSION['ordersHistory'] += [count($_SESSION['ordersHistory']) => $_SESSION['orders']];
  } else {
    $_SESSION['date'] = [0 => $date];
    $_SESSION['ordersHistory'] = [0 => $_SESSION['orders']];
  }
  unset($_SESSION['orders']);
  unset($_SESSION['csrf_token']);
  exit();
} else if (isset($_SESSION['ordersHistory'])) {
  $orders = $_SESSION['ordersHistory'];
} else {
  echo 'まだ何も注文してません';
  exit();
}
$date = $_SESSION['date'];
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
  <?php for ($j = count($date)-1; $j >=0; $j--) { ?>
    <h3 class="center"><?= $date[$j] ?></h3>
    <table border="1">
      <tr>
        <th>商品名</th>
        <th>価格</th>
        <th>数量</th>
      </tr>
      <?php
      foreach ($orders[$j] as $order) { ?>
        <tr>
          <td><?php echo $order['menu']; ?></td>
          <td><?php echo $order['price']; ?>円</td>
          <td><?php echo $order['amount']; ?></td>
        </tr>
      <?php $total += $order['price'] * $order['amount'];
      } ?>
      <tr>
        <th>合計</th>
        <td><?php echo $total ?>円</td>
      </tr>
    </table>
  <?php $total = 0;
  } ?>
  <style>
    .center {
      text-align: center;
    }

    .btn {
      margin-top: 20px;
      width: 15%;
      font-size: 18px;
    }

    h3 {
      margin-top: 50px;
    }

    table {
      width: 40%;
      margin: auto;
    }

    td {
      white-space: nowrap;
    }

    .delete {
      width: 100%;
    }
  </style>
</body>

</html>
