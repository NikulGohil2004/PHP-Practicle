<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'Config.php';

$errors = [];
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    /* ===== VALIDATION ===== */
    if ($email === '') {
        $errors[] = "Email is mandatory";
    }

    if ($password === '') {
        $errors[] = "Password is mandatory";
    }

    /* ===== CHECK LOGIN ===== */
    if (empty($errors)) {

        $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $row['id'];
            header("Location: Display.php");
            exit;
        } else {
            $errors[] = "Invalid email or password";
        }
    }
}
