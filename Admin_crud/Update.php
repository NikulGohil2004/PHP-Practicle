<?php
include 'Config.php';

$id = $_GET['id'];
$select = "SELECT * FROM student WHERE id='$id'";
$data = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($data);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $addres = $_POST['addres'];
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $hobby = implode(", ", $_POST['hobby']);
    
    /* Get the name of the file uploaded to Apache */
    $filename = $_FILES['uploadfile']['name'];
    /* Prepare to save the file upload to the upload folder */
    $location = "upload/".$filename;
    /* Permanently save the file upload to the upload folder */
    if ( !move_uploaded_file($_FILES['uploadfile']['tmp_name'], $location) ) { 
      echo '<p>The php and HTML5 file upload failed. Error code: ' . $_FILES['uploadfile']['error'] . '</p>'; 
    }
    //validation
      if(empty($_POST['firstName'])){  
         echo "<script>alert('FirstName is mandatory')</script>";
      }elseif (empty($_POST['lastName'])){
         echo "<script>alert('lastName is mandatory')</script>";
      }elseif (empty($_POST['email'])){
         echo "<script>alert('Email is mandatory')</script>";
      }elseif(empty($_POST['password'])){
         echo "<script>alert('Password is mandatory')</script>";
      }elseif (strlen($_POST['password']) < 6){
         echo "<script>alert('Password must be more than 6 Character')</script>";
      }else{

        $sql = "UPDATE student SET 
                firstName='$firstName',
                lastName='$lastName',
                email='$email',
                password='$password',
                addres='$addres',
                phoneNumber='$phoneNumber',
                gender='$gender',
                country='$country',
                hobby='$hobby',
                filenam='$filename'
                WHERE id='$id'";
            }
    if (mysqli_query($con, $sql)) {
        echo '<script>window.location.href = "Dasboard.php";</script>';   
    }else{
        echo "Error: " . mysqli_error($con);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update</title>
    <style>
    label {
        font-weight: 500;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container row justify-content-center">
        <div class="card card-info card-outline mb-4 mt-4 w-50 ">
            <div class="card-header text-center">
                <div class="card-title">UPDATE STUDENT</div>
            </div>
            <form method="post"  enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 ">
                            <label for="validationCustom01" class="form-label">First name</label>
                            <input type="text" name="firstName" class="form-control"
                                value="<?php echo $row['firstName']; ?>" required />
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Last name</label>
                            <input type="text" name="lastName" class="form-control"
                                value="<?php echo $row['lastName']; ?>" required />
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustomUsername" class="form-label">Email</label>
                            <div class="input-group has-validation">
                                <input type="email" name="email" class="form-control"
                                    value="<?php echo $row['email']; ?>" aria-describedby="inputGroupPrepend"
                                    required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                value="<?php echo $row['password']; ?>" id="validationCustom03" required />
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Address</label>
                            <input type="text" class="form-control" name="addres" required />
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Phone-Number</label>
                            <input type="number" name="phoneNumber" class="form-control" required />
                        </div>
                        <div class="col-md-4">
                            <label class="form-check-label" for="radioDefault1">
                                Gender
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="male">
                                <label class="form-check-label" for="radioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Female">
                                <label class="form-check-label " for="radioDefault2">
                                    Female
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-check-label" for="radioDefault1">
                                Hobby
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="Carrom">
                                <label class="form-check-label" for="checkDefault">
                                    Carrom
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="Chess">
                                <label class="form-check-label" for="checkChecked">
                                    Chess
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom04" class="form-label">Country</label>
                            <select class="form-select" name="country" required>
                                <option value="India">INDIA
                                </option>
                                <option value="USA">USA</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Profile Image (Current: <?php echo $row['filenam']; ?>)</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="uploadfile" />
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <input class="btn btn-info" name="submit" value="Update" type="submit" /><br>
                        </div>
                        <div>
                        </div>
            </form>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
                crossorigin="anonymous"></script>
        </div>
</body>

</html>