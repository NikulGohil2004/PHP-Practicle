<?php
$cookie_name = "Nikul";
$cookie_value = "parmar"; 
setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/");

?>
<html>
<body>
<?php
echo "The cookie 'user' value has been updated to: " . $_COOKIE[$cookie_name];
?>
</body>
</html>
