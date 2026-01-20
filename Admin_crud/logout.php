<?php
session_start();
$_SESSION = array();
session_destroy();
echo "session destroyed";
header("Location: Login.php");
exit();
?>