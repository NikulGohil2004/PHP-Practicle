

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
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
        <div class="card-title">STUDENT LOGIN</div>
      </div>
      <!--end::Header-->
      <!--begin::Form-->
      <form method="post"  enctype="multipart/form-data">
        <!--begin::Body-->
        <div class="card-body">
          <!--begin::Row-->
          <div class="row g-3">
           
            <!--begin::Col-->
            <div class="col-md-12">
              <label for="validationCustomUsername" class="form-label">Email</label>
              <div class="input-group has-validation">

                <input type="email" name="email" class="form-control" 
                  aria-describedby="inputGroupPrepend" />
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-12">
              <label for="validationCustom03" class="form-label">Password</label>
              <input type="password" name="password" class="form-control"   />

            </div>
            <!--end::Col-->
         
            <!--begin::Footer-->
            <div class="card-footer text-center">
              <input class="btn btn-info" name="login" value="Login" type="submit" />
              <div>
              <a href="Register.php" >Register Your Account.</a>
</div>
            </div>
            <!--end::Footer-->
      </form>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    </div>
</body>

</html>



<?php
include 'Config.php';
session_start();
if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password =$_POST['password'];


  $sql="SELECT * FROM student WHERE email='$email' and password='$password'";
 $result=mysqli_query($con,$sql);
 $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

 
if(mysqli_num_rows($result) >0)
{
$_SESSION['user'] = $row['id']; // Initializing Session
header("location: Dasboard.php"); // Redirecting To Other Page
}else
{
echo "<script>alert('Email and password incorrect')</script>";
}

}