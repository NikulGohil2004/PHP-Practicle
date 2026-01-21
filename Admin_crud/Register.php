<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'Config.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstName = trim($_POST['firstName']);
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword =$_POST['confirmPassword'];

    //validation
     if(empty($_POST['firstName'])){  
         echo "<script>alert('FirstName is mandatory')</script>"; 
     }elseif (empty($_POST['lastName'])){
         echo "<script>alert('lastName is mandatory')</script>";
     }elseif (empty($_POST['email'])){
         echo "<script>alert('Email is mandatory')</script>";
     }elseif(empty($_POST['password'])){
         echo "<script>alert('Password is mandatory')</script>";
     }elseif(empty($_POST['confirmPassword'])){
         echo "<script>alert('confirmPassword is mandatory')</script>";
     }elseif (strlen($_POST['password']) < 6){
         echo "<script>alert('Password must be more than 6 Character')</script>";
     }elseif ($password !== $confirmPassword) {
          echo "<script>alert('Password does not match')</script>";
     }else{
         $sql = "INSERT INTO `student` 
                (firstName,lastName,email,
                password) VALUES('$firstName','$lastName',
                '$email','$password') "; 
     }
	  if(mysqli_query($con, $sql)) 
      { 
        header('location:login.html');
      } 
    }
