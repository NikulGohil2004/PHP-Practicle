<?php
  session_start();
?>

<html>
 <body>
    <?php
    $_SESSION['name']="Nikul";
    $_SESSION['surname']="Gohil";
    echo " session is set";
    ?>
</body>
</html>