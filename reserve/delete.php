<?php
session_start();
$orders = $_SESSION['orders'];
$index = $_GET['index'];
unset($orders[$index]);
$_SESSION['id'] = count($orders)+1;
$_SESSION['orders'] = $orders;
header("Location: order.php");
exit();
