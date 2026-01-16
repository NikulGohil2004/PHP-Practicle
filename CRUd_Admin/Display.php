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

    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title text-center">STUDENT RECORDS</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php
include 'Config.php'; 

$sql = "SELECT * FROM `student`";
$result = mysqli_query($con, $sql);
$target_dir = "upload/";


if (mysqli_num_rows($result) > 0) {
  echo " <table class='table table-bordered'>";
  echo "<thead><tr><th>ID</th><th>First-Name</th><th>Last-Name</th><th>Email</th><th>Password</th><th>Address</th><th>Phone-NO</th><th>Gender</th><th>Country</th><th>Hobby</th><th>File(IMAGE)</th><th>Delete</th><th>Update</th></tr></thead>";
  
  echo "<tbody>";




  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr class='align-middle'>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["firstName"] . "</td>";
    echo "<td>" . $row["lastName"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["passwor"] . "</td>";
    echo "<td>" . $row["addres"] . "</td>";
    echo "<td>" . $row["phoneNumber"] . "</td>";
    echo "<td>" . $row["gender"] . "</td>";
    echo "<td>" . $row["country"] . "</td>";
    echo "<td>" . $row["hobby"] . "</td>";
  
    echo "<td><img src='upload/{$row['filenam']}' width='100' height='100' ></td>";
    echo "<td><button class='btn btn-warning'><a  href=\"Delete.php?id=" . $row["id"] . "\">Delete</a></button></td>";
    echo "<td><button class='btn btn-info'><a href=\"Update.php?id=" .$row["id"] ."\">Update</a></button></td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";

} else {
  echo "<h6 class='text-center'>NO RECORD FOUND.<br><a href='Insert.html' >Add here.</a></h6>";
}

 
mysqli_close($con);
?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /.card -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>