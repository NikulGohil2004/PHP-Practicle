<?php
include 'Config.php';
session_start();
if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password =$_POST['password'];

  $sql="SELECT * FROM student WHERE email='$email' and password='$password'";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

if(mysqli_num_rows($result) >0)
{
$_SESSION['user'] = $row['id'];
header("location: Dasboard.php");
}else
{
echo "<script>alert('Email and password incorrect')</script>";
}
}