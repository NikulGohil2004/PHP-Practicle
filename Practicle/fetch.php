<?php
include "db.php";
header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = $_POST['id'];  
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row); 
    } else {
        echo json_encode([]); 
    }
}



