<?php
session_start();
include 'Config.php';

if (!isset($_GET['id'])) {
    die("ID not found");
}

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id='$id'";

if (mysqli_query($con, $sql)) {

    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
        session_unset();
        session_destroy();
        header("Location: login_form.php");
        exit;
    }

    header("Location: Display.php");
    exit;

} else {
    echo "Error deleting record: " . mysqli_error($con);
}
