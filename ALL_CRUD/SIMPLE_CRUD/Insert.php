<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'Config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $addres = $_POST['addres'];
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];

    $hobby = isset($_POST['hobby']) ? implode(", ", $_POST['hobby']) : "";

    $target_dir = "upload/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $original_name = $_FILES['uploadfile']['name'];
    $tempname = $_FILES['uploadfile']['tmp_name'];

    $ext = pathinfo($original_name, PATHINFO_EXTENSION);

    $filename = time() . "_" . rand(1000, 9999) . "." . $ext;

    $folder = $target_dir . $filename;
    move_uploaded_file($tempname, $folder);

    $sql = "INSERT INTO students 
        (firstName, lastName, email, password, addres, phoneNumber, gender, country, hobby, filenam)
        VALUES 
        ('$firstName', '$lastName', '$email', '$password', '$addres', '$phoneNumber', '$gender', '$country', '$hobby', '$filename')";

    if (mysqli_query($con, $sql)) {
        header("Location: Display.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>