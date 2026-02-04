<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'Config.php';

$errors = [];
$firstName = $lastName = $email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = trim($_POST['firstName'] ?? '');
    $lastName  = trim($_POST['lastName'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if ($firstName === '') $errors[] = "First Name is mandatory";
    if ($lastName === '')  $errors[] = "Last Name is mandatory";
    if ($email === '')     $errors[] = "Email is mandatory";
    if ($password === '')  $errors[] = "Password is mandatory";
    if ($confirmPassword === '') $errors[] = "Confirm Password is mandatory";

    if ($password !== '' && strlen($password) < 6)
        $errors[] = "Password must be at least 6 characters";

    if ($password !== '' && $confirmPassword !== '' && $password !== $confirmPassword)
        $errors[] = "Password and Confirm Password do not match";

 
    if ($email !== '') {
        $checkEmail = "SELECT id FROM students WHERE email='$email'";
        $checkResult = mysqli_query($con, $checkEmail);

        if (mysqli_num_rows($checkResult) > 0) {
            $errors[] = "Email already registered. Please use another email.";
        }
    }

    if (empty($errors)) {

        $sql = "INSERT INTO students (firstName, lastName, email, password)
                VALUES ('$firstName', '$lastName', '$email', '$password')";

        if (mysqli_query($con, $sql)) {
            header("Location: login_form.php");
            exit;
        } else {
            $errors[] = "Database error: " . mysqli_error($con);
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        label { font-weight: 500; }
    </style>
</head>

<body>
<div class="container row justify-content-center">
    <div class="card card-info card-outline mb-4 mt-4 w-50">

        <div class="card-header text-center">
            <div class="card-title">STUDENT REGISTER</div>
        </div>

        <?php if (!empty($errors)) { ?>
            <div class="alert alert-danger text-center m-3">
                <?php foreach ($errors as $error) { ?>
                    <div><?php echo $error; ?></div>
                <?php } ?>
            </div>
        <?php } ?>

        <form method="post">
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">First name</label>
                        <input type="text" name="firstName" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Last name</label>
                        <input type="text" name="lastName" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control">
                    </div>

                </div>
            </div>

            <div class="card-footer text-center">
                <input class="btn btn-info" value="Register" type="submit">
            </div>
        </form>

    </div>
</div>
</body>
</html>
