<?php

$con = mysqli_connect("localhost","root","admin123","user");

if(!$con){
   
    $db_error = mysqli_connect_error();
}
