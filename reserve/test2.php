<?php

session_start();
if($_SESSION['date']){
  $date = $_SESSION['date'];
  setcookie("0[$date][0]", 0, time() + 60);
  setcookie("0[$date][1]", 0, time() + 60);
  setcookie("0[$date][2]", 0, time() + 60);
  if (isset($_COOKIE)) {
    var_dump($_COOKIE) . "<br>";
    echo count($_COOKIE[0]);
  }
}
