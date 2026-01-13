<?php
$servername = "localhost";
$username = "root";
$dbname = "user";   
$password = "admin123";

$con= new mysqli($servername, $username, $password, $dbname);

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
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