<?php
include 'Config.php'; 

$sql = "SELECT * FROM `students`";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  echo "<table border='1' cellspadding='0'>";
  echo "<thead><tr><th>ID</th><th>First-Name</th><th>Last-Name</th><th>Email</th><th>Password</th><th>Address</th><th>Phone-NO</th><th>Gender</th><th>Country</th><th>Hobby</th><th>File(IMAGE)</th><th>Delete</th><th>Update</th></tr></thead>";
  echo "<tbody>";


  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
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
   
    echo "<td><button><a href=\"Delete.php?id=" . $row["id"] . "\">Delete</a></button></td>";

    echo "<td><button><a href=\"Update.php?id=" .$row["id"] ."\">Update</a></button></td>";
    echo "</tr>";
  }

  echo "</tbody>";
  echo "</table>";
} else {
  echo "<h1>NO RECORD FOUND</h1>";
}


mysqli_close($con);
