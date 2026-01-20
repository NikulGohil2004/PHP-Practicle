<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
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
        <div class="card-title">STUDENT REGISTER</div>
      </div>
      <!--end::Header-->
      <!--begin::Form-->
      <form method="post" >
        <!--begin::Body-->
        <div class="card-body">
          <!--begin::Row-->
          <div class="row g-3">
            <!--begin::Col-->
            <div class="col-md-6">
              <label for="validationCustom01" class="form-label">First name</label>
              <input type="text" name="firstName" class="form-control"  />
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6">
              <label for="validationCustom02" class="form-label">Last name</label>
              <input type="text" name="lastName" class="form-control"   />

            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4">
              <label for="validationCustomUsername" class="form-label">Email</label>
              <div class="input-group has-validation">

                <input type="email" name="email" class="form-control" 
                  aria-describedby="inputGroupPrepend" />
              </div>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4">
              <label for="validationCustom03" class="form-label">Password</label>
              <input type="password" name="password" class="form-control"   />

            </div>
            <!--end::Col-->
             <!--begin::Col-->
            <div class="col-md-4">
              <label for="validationCustom03" class="form-label">Confirm-Password</label>
              <input type="password" name="confirmPassword" class="form-control"  />

            </div>
            <!--end::Col-->
          

            <!--begin::Footer-->
            <div class="card-footer text-center">
              <input class="btn btn-info" name="submit" value="Register" type="submit" />
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


    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstName = trim($_POST['firstName']);
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword =$_POST['confirmPassword'];

    //validation
     if(empty($_POST['firstName']))
       {  
         echo "<script>alert('FirstName is mandatory')</script>";
         
       }elseif (empty($_POST['lastName'])) {
         echo "<script>alert('lastName is mandatory')</script>";

       }elseif (empty($_POST['email'])) {
         echo "<script>alert('Email is mandatory')</script>";
       }
       elseif(empty($_POST['password']))
       {
         echo "<script>alert('Password is mandatory')</script>";

       }elseif (strlen($_POST['password']) < 6) {
         echo "<script>alert('Password must be more than 6 Character')</script>";
       }else{
         $sql = "INSERT INTO `student` 
                (firstName,lastName,email,
                password) VALUES('$firstName','$lastName',
                '$email','$password') "; 
       
       }
	  if (mysqli_query($con, $sql)) 
      { 
        header('location:Login.php');
      } 

    }
    
     ?>