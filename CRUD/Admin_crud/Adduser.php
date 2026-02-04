<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); 
if (!isset($_SESSION['user_id'])) {
    header('Location: login_form.php');
    exit(); 
}

include 'Config.php';

$errors = [];

$firstName = $lastName = $email = $password = $addres = $phoneNumber = '';
$gender = $country = '';
$hobbyArr = [];
$filename = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName   = trim($_POST['firstName'] ?? '');
    $lastName    = trim($_POST['lastName'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $password    = $_POST['password'] ?? '';
    $addres      = trim($_POST['addres'] ?? '');
    $phoneNumber = trim($_POST['phoneNumber'] ?? '');
    $gender      = $_POST['gender'] ?? '';
    $country     = $_POST['country'] ?? '';
    $hobbyArr    = $_POST['hobby'] ?? [];
     $old = $_POST;
    if ($firstName === '') $errors[] = "First Name is mandatory";
    if ($lastName === '')  $errors[] = "Last Name is mandatory";
    if ($email === '')     $errors[] = "Email is mandatory";
    if ($password === '')  $errors[] = "Password is mandatory";
    elseif (strlen($password) < 6)
        $errors[] = "Password must be at least 6 characters";

    if ($addres === '')    $errors[] = "Address is mandatory";
    if (empty($phoneNumber)) {
    $errors[] = 'Phone Number is mandatory';
     } elseif (strlen($phoneNumber) !== 10) {
    
    $errors[] = 'Phone Number must be 10 digits';
     }
    if ($gender === '')    $errors[] = "Gender is mandatory";
    if ($country === '')   $errors[] = "Country is mandatory";
    if (empty($hobbyArr))  $errors[] = "At least one hobby is required";

    if ($email !== '') {
        $check = mysqli_query($con, "SELECT id FROM students WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $errors[] = "Email already exists";
        }
    }

    $hobby = implode(", ", $hobbyArr);

    if (!empty($_FILES['uploadfile']['name'])) {

        $uploadDir = "upload/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $ext = pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION);
        $filename = time() . "_" . rand(1000,9999) . "." . $ext;

        move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadDir.$filename);
    } else {
        $errors[] = "Profile image is mandatory";
    }

    if (empty($errors)) {

        $sql = "INSERT INTO students
        (firstName, lastName, email, password, addres, phoneNumber, gender, country, hobby, filenam)
        VALUES
        ('$firstName','$lastName','$email','$password','$addres','$phoneNumber','$gender','$country','$hobby','$filename')";

        if (mysqli_query($con, $sql)) {
            header("Location: Display.php");
            exit;
        } else {
            $errors[] = "Database error: " . mysqli_error($con);
        }
    }
}
?>
<?php include(__DIR__ . '/../ADMIN/header.php'); ?>
<?php include(__DIR__ . '/../ADMIN/sidebar.php'); ?>

<div class="container row justify-content-center">
    <div class="card card-info card-outline mb-4 mt-4 w-50">

        <div class="card-header text-center">
            <div class="card-title">ADD STUDENT</div>
        </div>

        <?php if (!empty($errors)) { ?>
        <div class="alert alert-danger text-center m-3">
            <?php foreach ($errors as $error) { ?>
            <div><?php echo $error; ?></div>
            <?php } ?>
        </div>
        <?php } ?>

        <form method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">First name</label>
                        <input type="text" name="firstName" class="form-control"
                            value="<?= htmlspecialchars($old['firstName'] ?? '') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Last name</label>
                        <input type="text" name="lastName" class="form-control"
                            value="<?= htmlspecialchars($old['lastName'] ?? '') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control"
                            value="<?= htmlspecialchars($old['password'] ?? '') ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <input type="text" name="addres" class="form-control" value="<?php echo $addres; ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone-Number</label>
                        <input type="number" name="phoneNumber" class="form-control"
                            value="<?php echo $phoneNumber; ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Gender</label><br>
                        <input type="radio" name="gender" value="male" <?php if($gender=="male") echo "checked"; ?>>
                        Male
                        <input type="radio" name="gender" value="female" <?php if($gender=="female") echo "checked"; ?>>
                        Female
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Hobby</label><br>
                        <input type="checkbox" name="hobby[]" value="Carrom"
                            <?php if(in_array("Carrom",$hobbyArr)) echo "checked"; ?>> Carrom
                        <input type="checkbox" name="hobby[]" value="Chess"
                            <?php if(in_array("Chess",$hobbyArr)) echo "checked"; ?>> Chess
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Country</label>
                        <select class="form-select" name="country">
                            <option value="">Select</option>
                            <option value="India" <?php if($country=="India") echo "selected"; ?>>INDIA</option>
                            <option value="USA" <?php if($country=="USA") echo "selected"; ?>>USA</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Profile Image</label>
                        <input type="file" name="uploadfile" class="form-control">
                    </div>

                </div>
            </div>

            <div class="card-footer text-center">
                <input class="btn btn-info" value="Add User" type="submit">
            </div>

        </form>
    </div>
</div>

<?php include(__DIR__ . '/../ADMIN/footer.php'); ?>