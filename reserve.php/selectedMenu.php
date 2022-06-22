<?php
require 'template.php';
require 'function.php';
$orders = $_SESSION;
//トークン作成
$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
$_SESSION = $orders;
$_SESSION['csrf_token'] = $csrf_token;
unset($_SESSION['err']);
$id = $_GET['id'];
$pdo = pdoConnect();
$sql = "SELECT * FROM menus WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="main">
  <img class="float-test" src="<?php echo $result['picture']; ?>" alt="" width=50%>
  <h1 class="center"><?php echo $result['menu']; ?> <?php echo $result['price']; ?>円</h1>
  <p class="fontS"><?php echo $result['detail']; ?></p>
  <form action="order.php" id="order.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <input type="hidden" value="<?php echo $id; ?>" name="id">
    <input type="hidden" value="<?php echo $result['menu']; ?>" name="menu">
    <input type="hidden" value="<?php echo $result['price']; ?>" name="price">
    <p class="fontS">

      <button type="submit" id="orderButton">注文する</button>

      </label>&emsp; 数量
      <select name="amount" class="select1" form="order.php">
        <option value="1">1</option>
        <option value="10">10</option>
        <option value="9">9</option>
        <option value="8">8</option>
        <option value="7">7</option>
        <option value="6">6</option>
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
      </select>
    </p>
  </form>
</div>
<style>
  .main {
    margin-top: 100px;
  }

  .float-test {
    float: left;
    margin-right: 8px;
    margin-bottom: 8px;
    height: 350px;
  }

  .fontS {
    font-size: 25px;
  }

  .select1 {
    font-size: 20px;
  }

  button {
    width: 11%;
    font-size: 19px;
  }

  .err {
    color: red;
  }

  .buttonC {
    background-color: lightblue;
  }
</style>
<script>
  if (document.getElementById('loginName') == null) {
    let element = document.getElementById('orderButton');
    element.disabled = true;
    element = document.getElementById('order.php');
    let p = document.createElement('p');
    p.setAttribute('class', 'err');
    p.innerHTML = "注文するにはログインしてください";
    element.append(p);
  }
</script>
</body>

</html>
