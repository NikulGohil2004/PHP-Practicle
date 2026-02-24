<?php
$server="localhost";
$username="root";
$password="admin123";
$database="user";

$con=new mysqli($server,$username,$password,$database);

if(!$con){
    die("Not conected");
}