<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'Config.php';

$errors = [];
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $old = $_POST;

    if ($email === '') {
        $errors[] = "Email is mandatory";
    }

    if ($password === '') {
        $errors[] = "Password is mandatory";
    }

    if (empty($errors)) {

        $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

          
            $_SESSION['user_id']        = $row['id'];
            $_SESSION['user_firstName'] = $row['firstName'];
            $_SESSION['user_email']     = $row['email'];
            $_SESSION['user_image']     = $row['filenam'];

            header("Location: Display.php");
            exit;
        } else {
            $errors[] = "Invalid email or password";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    label { font-weight: 500; }
  </style>
</head>

<body>
<div class="container row justify-content-center">
  <div class="card card-info card-outline mb-4 mt-4 w-50">

    <div class="card-header text-center">
      <div class="card-title">STUDENT LOGIN</div>
    </div>

    <?php if (!empty($errors)) { ?>
      <div class="alert alert-danger text-center m-3">
        <?php foreach ($errors as $error) { ?>
          <div><?= $error ?></div>
        <?php } ?>
      </div>
    <?php } ?>

    <form method="post">
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-12">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                  value="<?= htmlspecialchars($old['email'] ?? '') ?>">
          </div>

          <div class="col-md-12">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?= htmlspecialchars($old['password'] ?? '') ?>">
          </div>
        </div>
      </div>

      <div class="card-footer text-center">
        <button class="btn btn-info">Login</button><br>
        <a href="Register.php">Register here.</a>
      </div>
    </form>

  </div>
</div>
</body>
</html>
