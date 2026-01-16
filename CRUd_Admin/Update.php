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
    $passwor = $_POST['password'];
    $addres = $_POST['addres'];
    $phoneNumber = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $hobby = implode(", ", $_POST['hobby']);

  
    $filename = $_FILES['uploadfile']['name'];

    if (!empty($filename)) {
        $target_dir = "upload/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_dir.$filename);
    } else {
        $filename = $row['filenam']; 
    }
     
    //validation
    
    

    $sql = "UPDATE student SET 
        firstName='$firstName',
        lastName='$lastName',
        email='$email',
        passwor='$passwor',
        addres='$addres',
        phoneNumber='$phoneNumber',
        gender='$gender',
        country='$country',
        hobby='$hobby',
        filenam='$filename'
        WHERE id='$id'";

    if (mysqli_query($con, $sql)) {
        header("Location: Display.php");
        exit();
    } else {
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
        <!--begin::Form Validation-->
        <div class="card card-info card-outline mb-4 mt-4 w-50 ">
            <!--begin::Header-->
            <div class="card-header text-center">
                <div class="card-title">UPDATE STUDENT</div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form method="post" enctype="multipart/form-data">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Row-->
                    <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6 ">
                            <label for="validationCustom01" class="form-label">First name</label>
                            <input type="text" name="firstName" class="form-control"
                                value="<?php echo $row['firstName']; ?>"  required />
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Last name</label>
                            <input type="text" name="lastName" class="form-control"
                                value="<?php echo $row['lastName']; ?>"  required />

                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustomUsername" class="form-label">Email</label>
                            <div class="input-group has-validation">

                                <input type="email" name="email" class="form-control"
                                    value="<?php echo $row['email']; ?>" 
                                    aria-describedby="inputGroupPrepend" required />
                            </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                value="<?php echo $row['passwor']; ?>" id="validationCustom03" required />

                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Address</label>
                            <input type="text" class="form-control" name="addres"
                                value="<?php echo $row['addres']; ?>" required/>

                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Phone-Number</label>
                            <input type="number" name="phoneNumber" value="<?php echo $row['phoneNumber']; ?>"
                                class="form-control"  required />

                        </div>
                        <!--end::Col-->
                        <div class="col-md-4">
                            <label class="form-check-label" for="radioDefault1">
                                Gender
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="male"
                                    <?php if($row['gender']=="male") echo "checked"; ?> >
                                <label class="form-check-label" for="radioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Female"
                                    <?php if($row['gender']=="Female") echo "checked"; ?> >
                                <label class="form-check-label " for="radioDefault2">
                                    Female
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php $hobbies = explode(", ", $row['hobby']); ?>
                            <label class="form-check-label" for="radioDefault1">
                                Hobby
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="Carrom"
                                    <?php if(in_array("Carrom",$hobbies)) echo "checked"; ?> >
                                <label class="form-check-label" for="checkDefault">
                                    Carrom
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="Chess"
                                    <?php if(in_array("Chess",$hobbies)) echo "checked"; ?> >
                                <label class="form-check-label" for="checkChecked">
                                    Chess
                                </label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom04" class="form-label">Country</label>
                            <select class="form-select"  name="country" required>
                                <option value="India" <?php if($row['country']=="India") echo "selected"; ?>>INDIA
                                </option>
                                <option value="USA" <?php if($row['country']=="USA") echo "selected"; ?>>USA</option>
                            </select>
                        </div>

                        <div class="col-md-6 ">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="uploadfile" value=""
                                     required />
                            </div>
                            <div class="cold-md-6">
                                <img src="upload/<?php echo $row['filenam']; ?>" width="100"><br>
                            </div>
                        </div>

                        <!--begin::Footer-->

                        <div class="card-footer text-center">

                            <input class="btn btn-info" name="submit" value="Update" type="submit" />
                        </div>
                        <!--end::Footer-->
            </form>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
                crossorigin="anonymous"></script>
        </div>
</body>

</html>