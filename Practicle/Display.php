<?php
include 'db.php';

$sql="SELECT * FROM users ";
$result = mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($result)){

?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['FirstName']; ?></td>
    <td><?php echo $row['LastName']; ?></td>
    <td><?php echo $row['Email']; ?></td>
    <td><?php echo $row['Password']; ?></td>
    <td><?php echo $row['Gender']; ?></td>
    <td><?php echo $row['Language']; ?></td>
    <td><?php echo $row['Subjects']; ?></td>
    <td><img src="upload/<?php echo $row['Image']; ?>" width="100"></td>
    <td><button class="btn btn-warning editBtn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?php echo $row['id']; ?>">
        Update
        </button>
    </td>

    <td>
        <button 
            class="btn btn-danger deleteBtn"
            data-id="<?php echo $row['id']; ?>">
            Delete
        </button>
    </td>
</tr>
<?php
}
?>