<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="test2.php">
    <span id="aaa"></span>
    <button type="submit" id="orderButton" disabled>注文する</button>
    <script>
      let element = document.getElementById('orderButton');
      let span = document.getElementById('aaa');
      span = span.innerHTML;
      if(span == ""){
        console.log('win');
      }
      // element.addEventListener('click', function() {
      //   alert('click');
      // })
      element.disabled = true;
    </script>
  </form>
</body>

</html>
