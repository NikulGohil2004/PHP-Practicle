<?php
  session_start();
?>

<html>
 <body>
    <?php
    if(isset($_SESSION['name'])){
        echo "name is". $_SESSION['name']."<br>";
        echo "surname is". $_SESSION['surname']."<br>";
    }else{
        echo "no session found in this page";
    }
    
    ?>
</body>
</html>