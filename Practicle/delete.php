<?php
include "db.php";

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM users WHERE id = '$id'";
    
    if(mysqli_query($con, $query)){
        echo "success";
    } else {
        echo "error";
    }
}


