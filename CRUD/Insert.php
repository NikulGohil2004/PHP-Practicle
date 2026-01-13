

<?php
include 'Config.php';


    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $passwor = $_POST['password'];
    $confirmPassword =$_POST['confirmPassword'];
    $addres= $_POST['addres'];
    $phoneNumber= $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $hobby=implode(", ", $_POST['hobby']);

      $target_dir = "upload/"; 
      $filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];
      if(!mkdir($target_dir)){
          $target_dir = "upload/"; 
         
         }
          $folder = $target_dir . $filename;
          move_uploaded_file($tempname, $folder);
    //       if (!is_dir($target_dir)) {
    //      echo "Error: The upload directory does not exist.";
    //       }
    
    //     elseif(move_uploaded_file($tempname, $folder)) {
    //     echo "uplaoded";
    //   } else {
    //       echo "not-uploaded";
    //  }
     // validation

      if(empty($_POST['firstName'])  || empty($_POST['lastName']) || empty($_POST['email']) )
       {  
         echo "<h1>FirstName,LastName,email fields are compulsory</h1>";
       }
       elseif(empty($_POST['password']))
       {
         echo "password is mandatory";
       }
       elseif(empty($_POST['confirmPassword']))
       {
         echo "confirmPassword is mandatory";
       }
       elseif($passwor !== $confirmPassword)
       {
         echo "password is not-matched";
       }
       elseif(empty($_POST['addres']))
       {
         echo "Address is mandatory";
       }
        elseif(empty($_POST['phoneNumber']))
        {
          echo "PHONE-NUMBER is mandatory.";
       }else
       {

         $sql = "INSERT INTO `student` 
                (firstName,lastName,email,
                passwor,addres,phoneNumber,
                gender,country,hobby,filenam) VALUES('$firstName','$lastName',
                '$email','$passwor','$addres','$phoneNumber',
                '$gender','$country','$hobby','$filename') "; 
       
       }
	  if (mysqli_query($con, $sql)) 
      { 
        header('location:Display.php');
      } 

     }
    
     ?>
