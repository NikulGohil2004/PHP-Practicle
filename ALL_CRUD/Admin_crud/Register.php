<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'Config.php';

$errors = [];
$firstName = $lastName = $email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = trim($_POST['firstName'] ?? '');
    $lastName  = trim($_POST['lastName'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if ($firstName === '') $errors[] = "First Name is mandatory";
    if ($lastName === '')  $errors[] = "Last Name is mandatory";
    if ($email === '')     $errors[] = "Email is mandatory";
    if ($password === '')  $errors[] = "Password is mandatory";
    if ($confirmPassword === '') $errors[] = "Confirm Password is mandatory";

    if ($password !== '' && strlen($password) < 6)
        $errors[] = "Password must be at least 6 characters";

    if ($password !== '' && $confirmPassword !== '' && $password !== $confirmPassword)
        $errors[] = "Password and Confirm Password do not match";

    /* ===== DUPLICATE EMAIL CHECK (ADDED) ===== */
    if ($email !== '') {
        $checkEmail = "SELECT id FROM students WHERE email='$email'";
        $checkResult = mysqli_query($con, $checkEmail);

        if (mysqli_num_rows($checkResult) > 0) {
            $errors[] = "Email already registered. Please use another email.";
        }
    }

    /* ===== INSERT ===== */
    if (empty($errors)) {

        $sql = "INSERT INTO students (firstName, lastName, email, password)
                VALUES ('$firstName', '$lastName', '$email', '$password')";

        if (mysqli_query($con, $sql)) {
            header("Location: login_form.php");
            exit;
        } else {
            $errors[] = "Database error: " . mysqli_error($con);
        }
    }
}

