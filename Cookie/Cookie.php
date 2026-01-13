<?php

$cookie_name = "Nikul";
$cookie_value = "Gohil";

setcookie($cookie_name, $cookie_value, time() + (86400*1), "/");
?>

<html>

 <body>

    <?php
      if(!isset($_COOKIE[$cookie_name])) {
         echo "Cookie name'" . $cookie_name . "' is not set!";
      } else {
         echo "Cookie '" . $cookie_name . "' is set!<br>";
         echo "Value is: " . $_COOKIE[$cookie_name];
      }
     ?>
    <br />
      <a href="cookieDelete.php">Delete</a>
      <a href="cookieModify.php">Modify</a>

 </body>

</html>