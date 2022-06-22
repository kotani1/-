<?php
session_start();
$count = 0;
if (isset($_SESSION['orders'])) {
  $orders = $_SESSION['orders'];
} else {
  $orders = [];
}

$id = count($orders);

//削除機能
if (!empty($orders)) {
  $keys = array_keys($orders);
  $index = count($keys) - 1;
  $id = $keys[$index] + 1;
  if ($id === count($orders)) {
    $id = count($orders);
  }
}

//トークン照合
if (isset($_SESSION["csrf_token"])) {
  if ($_POST["csrf_token"] === $_SESSION['csrf_token']) {
    $orders[] = [
      "id" => $id,
      "menu" => $_POST['menu'],
      "price" => $_POST['price'],
      "amount" => $_POST['amount']
    ];
  }
}
unset($_SESSION["csrf_token"]);

//トークン生成
$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;
$_SESSION['orders'] = $orders;
$total = 0;
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

  <div>
    <form action="menu.php" method="POST">
      <button class="btn">他の商品も注文する</button>
    </form>
    <form action="orderHistory.php" method="POST">
      <input type="hidden" value="aaa" name="complete">
      <input type="hidden" value="<?= $csrf_token?>" name="csrf_token">
      <button class="btn">注文を確定する</button>
    </form>
  </div>
  <table border="1">
    <tr>
      <th>商品名</th>
      <th>価格</th>
      <th>数量</th>
      <th>削除</th>
    </tr>
    <?php foreach ($orders as $order) { ?>
      <form action="delete.php" method="get">
        <tr>
          <input type="hidden" value="<?php echo $order['id']; ?>" name="index">
          <td><?php echo $order['menu']; ?></td>
          <td><?php echo $order['price']; ?>円</td>
          <td><?php echo $order['amount']; ?></td>
          <td><button class="delete">✕</button></td>
        </tr>
      </form>
    <?php $total += $order['price'] * $order['amount'];
    } ?>
    <tr>
      <th>合計</th>
      <td><?php echo $total ?>円</td>
    </tr>
  </table>
  <style>
    div {
      text-align: center;
    }

    .btn {
      margin-top: 20px;
      width: 15%;
      font-size: 18px;
    }

    table {
      width: 40%;
      margin: auto;
      margin-top: 50px;
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
