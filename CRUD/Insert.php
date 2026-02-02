<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert</title>
</head>

<body>
    <form method="post"   enctype="multipart/form-data">
        
    
        <label for="name">FirstName:</label>
        <input type="text" name="firstName"  ><br>
    
        

        <label>Last-Name:-</label>
        <input type="text" name="lastName" required /><br>

        <label>Email:-</label>
        <input type="email" name="email" required  /><br>

        <label>Password:-</label>
        <input type="password" name="password" required /><br>

        <label>Confirm-password:-</label>
        <input type="password" name="confirmPassword" required/><br>

        <label>Address:-</label>
        <textarea name="addres" required></textarea><br>
 

        <label>Phone-No:-</label>
        <input type="number" name="phoneNumber" required /><br>

        <label>Gender:-</label><br>
        Male:<input type="radio" name="gender" value="male" checked /><br>
        Female:<input type="radio" name="gender" value="female" /><br>

        <label for="category">Select Country:</label>
        <select name="country" required>
            <option value="India">India</option>
            <option value="Usa">USA</option>
        </select><br>

        <label>Hobby:-</label><br>
        <input type="checkbox" name=hobby[] value="cricket" required/>cricket<br>
        <input type="checkbox" name=hobby[] value="chess" />chess<br>

        
        <label>Profile-Image:-</label>
        <input type="file" name="uploadfile" value="" required/><br>




        <input type="submit" name="submit" value="submit" />

    </form>
</body>

</html>
<?php
error_reporting(E_ALL); // Report all errors, warnings, and notices
ini_set('display_errors', '1'); // Display errors in the browser
ini_set('display_startup_errors', '1'); 
include 'Config.php';


    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
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


         $sql = "INSERT INTO `students` 
                (firstName,lastName,email,
                password,addres,phoneNumber,
                gender,country,hobby,filenam) VALUES('$firstName','$lastName',
                '$email','$password','$addres','$phoneNumber',
                '$gender','$country','$hobby','$filename') " or die ("query is not working"); 
       
       
	  if (mysqli_query($con, $sql)) 
      { 
        header('location:Display.php');
      } 

     }
    
     ?>
