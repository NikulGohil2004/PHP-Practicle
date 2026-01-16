<?php

session_start();
?>
<html>
<body>
    <?php
       session_unset(); // unset all the var in session
       session_destroy(); // destroy the session
     ?>

</body>
</html>