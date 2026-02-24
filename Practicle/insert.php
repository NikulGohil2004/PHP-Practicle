<?php
include 'db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $FirstName=$_POST['FirstName'];
  $LastName=$_POST['LastName'];
  $Email=$_POST['Email'];
  $Password=$_POST['Password'];
  $ConfirmPasword=['ConfirmPassword'];
  $Gender=$_POST['Gender'];
  $Language = implode(",", $_POST['Language'] ?? []);
  $Subjects = implode(",",$_POST['Subjects'] ?? []);

  $Image="";

  if($_FILES['Image']['name']){
     if(!is_dir("upload")){
        mkdir("upload");
     }
  }

  $Image = time()."_".$_FILES['Image']['name'];
  move_uploaded_file($_FILES['Image']['tmp_name'],"upload/".$Image);

  $sql = "INSERT INTO users (FirstName,
                             LastName,
                             Email,
                             Password,
                             Gender,
                             Language,
                             Subjects,Image) VALUES ('$FirstName',
                                                      '$LastName',
                                                      '$Email',
                                                      '$Password',
                                                      '$Gender',
                                                      '$Language',
                                                      '$Subjects',
                                                      '$Image')";
                                                    
 if(mysqli_query($con,$sql)){
    echo"added succes";
 }else{
    echo " geting error";
 }

}
