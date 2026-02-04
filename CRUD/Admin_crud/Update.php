<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login_form.php');
    exit(); 
}


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'Config.php';

$errors = [];

if (!isset($_GET['id'])) {
    die("ID not found");
}
$id = $_GET['id'];

$select = "SELECT * FROM students WHERE id='$id'";
$data = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Record not found");
}

$firstName = $row['firstName'];
$lastName = $row['lastName'];
$email = $row['email'];
$password = $row['password'];
$addres = $row['addres'];
$phoneNumber = $row['phoneNumber'];
$gender = $row['gender'];
$country = $row['country'];
$hobbyArr = explode(',', $row['hobby'] ?? ''); 
$filename = $row['filenam'];

$uploadServerPath = __DIR__ . "/upload/";

$uploadBrowserPath = "upload/";

$defaultImage = $uploadBrowserPath ;

$currentImage = $defaultImage;

if (!empty($filename) && file_exists($uploadServerPath . $filename)) {
    $currentImage = $uploadBrowserPath . $filename;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = trim($_POST['firstName'] ?? '');
    $lastName = trim($_POST['lastName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $addres = trim($_POST['addres'] ?? '');
    $phoneNumber = trim($_POST['phoneNumber'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $country = $_POST['country'] ?? '';
    $hobbyArr = $_POST['hobby'] ?? [];

    if ($firstName === '')
        $errors[] = "First Name is mandatory";
    if ($lastName === '')
        $errors[] = "Last Name is mandatory";
    if ($email === '')
        $errors[] = "Email is mandatory";
    if ($password === '')
        $errors[] = "Password is mandatory";
    elseif (strlen($password) < 6)
        $errors[] = "Password must be at least 6 characters";
    if ($addres === '')
        $errors[] = "Address is mandatory";
     if (empty($phoneNumber)) {
    $errors[] = 'Phone Number is mandatory';
     } elseif (strlen($phoneNumber) !== 10) {
    
    $errors[] = 'Phone Number must be 10 digits';
     }
    if ($gender === '')
        $errors[] = "Gender is mandatory";
    if ($country === '')
        $errors[] = "Country is mandatory";
    if (empty($hobbyArr))
        $errors[] = "At least one hobby is required";

    $hobby = implode(", ", $hobbyArr);

    if (!empty($_FILES['uploadfile']['name'])) {

        if (!is_dir($uploadServerPath)) {
            mkdir($uploadServerPath, 0777, true);
        }

        if (!empty($filename) && file_exists($uploadServerPath . $filename)) {
            unlink($uploadServerPath . $filename);
        }

        $ext = pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION);
        $filename = time() . "_" . rand(1000, 9999) . "." . $ext;

        move_uploaded_file(
            $_FILES['uploadfile']['tmp_name'],
            $uploadServerPath . $filename
        );
    }
    if (empty($errors)) {

        $sql = "UPDATE students SET
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

        if (mysqli_query($con, $sql)) {


            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
                $_SESSION['user_firstName'] = $firstName;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_image']=$filename;
            }

            header("Location: Display.php");
            exit;
        } else {
            $errors[] = "Database error: " . mysqli_error($con);
        }
    }
}
?>

<?php include(__DIR__ . '/../ADMIN/header.php'); ?>
<?php include(__DIR__ . '/../ADMIN/csslink.php'); ?>
<?php include(__DIR__ . '/../ADMIN/sidebar.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container row justify-content-center">
        <div class="card card-info card-outline mb-4 mt-4 w-50">

            <div class="card-header text-center">
                <div class="card-title">UPDATE STUDENT</div>
            </div>

            <?php if (!empty($errors)) { ?>
                <div class="alert alert-danger text-center m-3">
                    <?php foreach ($errors as $error) { ?>
                        <div><?= $error ?></div>
                    <?php } ?>
                </div>
            <?php } ?>

            <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" name="firstName" class="form-control" value="<?= $firstName ?>">
                        </div>

                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="lastName" class="form-control" value="<?= $lastName ?>">
                        </div>

                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $email ?>">
                        </div>

                        <div class="col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?= $password ?>">
                        </div>

                        <div class="col-md-6">
                            <label>Address</label>
                            <input type="text" name="addres" class="form-control" value="<?= $addres ?>">
                        </div>

                        <div class="col-md-6">
                            <label>Phone Number</label>
                            <input type="number" name="phoneNumber" class="form-control" value="<?= $phoneNumber ?>">
                        </div>

                        <div class="col-md-4">
                            <label>Gender</label><br>
                            <input type="radio" name="gender" value="male" <?= ($gender == "male") ? "checked" : "" ?>>
                            Male
                            <input type="radio" name="gender" value="female" <?= ($gender == "female") ? "checked" : "" ?>>
                            Female
                        </div>

                        <div class="col-md-4">
                            <label>Hobby</label><br>
                            <input type="checkbox" name="hobby[]" value="Carrom" <?= in_array("Carrom", $hobbyArr) ? "checked" : "" ?>> Carrom
                            <input type="checkbox" name="hobby[]" value="Chess" <?= in_array("Chess", $hobbyArr) ? "checked" : "" ?>> Chess
                        </div>

                        <div class="col-md-4">
                            <label>Country</label>
                            <select name="country" class="form-select">
                                <option value="India" <?= ($country == "India") ? "selected" : "" ?>>India</option>
                                <option value="USA" <?= ($country == "USA") ? "selected" : "" ?>>USA</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Profile Image</label><br>
                            <img src="<?= $currentImage ?>" style="width:120px;height:120px;border-radius:50%;
                                    object-fit:cover;border:1px solid #ccc;margin-bottom:8px;">
                            
                            <input type="file" name="uploadfile" class="form-control">
                        </div>

                    </div>
                </div>

                <div class="card-footer text-center">
                    <button class="btn btn-info">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php include(__DIR__ . '/../ADMIN/footer.php'); ?>