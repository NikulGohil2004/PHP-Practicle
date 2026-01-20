<?php
   include "Config.php";
   $id=$_REQUEST['id'];
   $delete = "DELETE from `student` where id =$id";
   $result = mysqli_query($con,$delete);
   header('location:Display.php');

   




