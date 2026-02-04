<?php
session_start(); 
if (!isset($_SESSION['user_id'])) {
    header('Location: login_form.php');
    exit(); 
}
?>

<?php include(__DIR__ . '/../ADMIN/header.php'); ?>
<?php include(__DIR__ . '/../ADMIN/sidebar.php'); ?>

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
   echo '<td><button class="btn btn-danger"><a href="Delete.php?id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this record?\');">Delete</a></button></td>';


    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
} else {
  echo "<h6 class='text-center'>NO RECORD FOUND.<br><a href='Register.php' >Add here.</a></h6>";
}
mysqli_close($con);
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php include(__DIR__ . '/../ADMIN/footer.php'); ?>