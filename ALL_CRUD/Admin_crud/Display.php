
          <?php include(__DIR__ . '/../ADMIN/header.php'); ?>

 <?php include(__DIR__ . '/../ADMIN/csslink.php'); ?>
      <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-rc3/dist/js/adminlte.min.js" crossorigin="anonymous">
      </script>
          <?php include(__DIR__ . '/../ADMIN/sidebar.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <style>
    a:link {
        color: white;
        text-decoration: none;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title text-center">STUDENT RECORDS</h3>
                    </div>
                    <div class="card-body">
                        <?php
include 'Config.php'; 

$sql = "SELECT * FROM `students`";
$result = mysqli_query($con, $sql);
$target_dir = "upload/";

if (mysqli_num_rows($result) > 0) {
  echo " <div class='table-responsive'>";
  echo " <table class='table table-bordered'>";
  echo "<thead class='text-center bg-info'><tr ><th class='bg-info'>ID</th><th class='bg-info'>First-Name</th><th class='bg-info'>Last-Name</th><th class='bg-info'>Email</th><th class='bg-info'>Password</th><th class='bg-info'>Address</th><th class='bg-info'>Phone-NO</th><th class='bg-info'>Gender</th><th class='bg-info'>Country</th><th class='bg-info'>Hobby</th><th class='bg-info'>File(IMAGE)</th><th class='bg-info'>Update</th><th class='bg-info'>Delete</th></tr></thead>";
  echo "<tbody>";

  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr class='align-middle text-center'>";
    echo "<td >" . $row["id"] . "</td>";
    echo "<td>" . $row["firstName"] . "</td>";
    echo "<td>" . $row["lastName"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["password"] . "</td>";
    echo "<td>" . $row["addres"] . "</td>";
    echo "<td>" . $row["phoneNumber"] . "</td>";
    echo "<td>" . $row["gender"] . "</td>";
    echo "<td>" . $row["country"] . "</td>";
    echo "<td>" . $row["hobby"] . "</td>";
    echo "<td><img src='upload/{$row['filenam']}' alt='NO IMAGE ' class='rounded' width='100' height='100' ></td>";
    echo "<td><button class='btn btn-warning'><a href=\"Update.php?id=" .$row["id"] ."\">Update</a></button></td>";
    echo "<td><button class='btn btn-danger'><a  href=\"Delete.php?id=" . $row["id"] . "\">Delete</a></button></td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
} else {
  echo "<h6 class='text-center'>NO RECORD FOUND.<br><a href='Adduser.php' >Add here.</a></h6>";
}
mysqli_close($con);
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>
 <?php include(__DIR__ . '/../ADMIN/footer.php'); ?>