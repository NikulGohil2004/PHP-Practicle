<?php
include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

       $id = $_POST['id'];
       $FirstName=$_POST['FirstName'];
       $LastName=$_POST['LastName'];
       $Email=$_POST['Email'];
       $Password=$_POST['Password'];
       $Gender=$_POST['Gender'];
       $Language = implode(",", $_POST['Language'] ?? []);
       $Subjects = implode(",",$_POST['edit_Subjects'] ?? []);


       $Image="";

      if($_FILES['Image']['name']){
        if(!is_dir("upload")){
          mkdir("upload");
       }
      }

  $Image = time()."_".$_FILES['Image']['name'];
  move_uploaded_file($_FILES['Image']['tmp_name'],"upload/".$Image);


  $sql="UPDATE users SET   
               FirstName='$FirstName',
               LastName='$LastName',
               Email='$Email',
               Password='$Password',
               Gender='$Gender',
               Language='$Language',
               Subjects='$Subjects',
               Image='$Image'

               WHERE id=$id";

    if(mysqli_query($con,$sql)){
        echo "executed";
    }else{
        echo "error while updating";
    }

}