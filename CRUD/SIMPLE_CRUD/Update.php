<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

include 'Config.php';

if (!isset($_GET['id'])) {
    die("ID not found");
}

$id = $_GET['id'];

$result = mysqli_query($con, "SELECT * FROM students WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Record not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName   = $_POST['firstName'];
    $lastName    = $_POST['lastName'];
    $email       = $_POST['email'];

    $password = !empty($_POST['password']) ? $_POST['password'] : $row['password'];

    $addres      = $_POST['addres'];
    $phoneNumber = $_POST['phoneNumber'];
    $gender      = $_POST['gender'];
    $country     = $_POST['country'];

    $hobby = isset($_POST['hobby']) ? implode(", ", $_POST['hobby']) : "";

    $filename = $row['filenam'];

    if (!empty($_FILES['uploadfile']['name'])) {

        $target_dir = "upload/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (!empty($row['filenam']) && file_exists($target_dir . $row['filenam'])) {
            unlink($target_dir . $row['filenam']);
        }

        $ext = pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION);
        $filename = time() . "_" . rand(1000, 9999) . "." . $ext;

        move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target_dir . $filename);
    }

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
        header("Location: Display.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Student</title>
</head>

<body>

    <form method="post" action="Update.php?id=<?php echo $row['id']; ?>" enctype="multipart/form-data">

        First Name:
        <input type="text" name="firstName" value="<?php echo $row['firstName']; ?>" required><br>

        Last Name:
        <input type="text" name="lastName" value="<?php echo $row['lastName']; ?>" required><br>

        Email:
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>

        Password:
        <input type="password" name="password" value="<?php echo $row['password']; ?>"><br>

        Address:
        <input type="text" name="addres" value="<?php echo $row['addres']; ?>" required><br>

        Phone:
        <input type="text" name="phoneNumber" value="<?php echo $row['phoneNumber']; ?>" required><br>

        Gender:<br>
        <input type="radio" name="gender" value="male" <?php if ($row['gender']=="male") { echo "checked"; } ?>>
        Male<br>

        <input type="radio" name="gender" value="female" <?php if ($row['gender']=="female") { echo "checked"; } ?>>
        Female<br>

        Country:
        <select name="country">
            <option value="India" <?php if ($row['country']=="India") { echo "selected"; } ?>>
                India
            </option>
            <option value="USA" <?php if ($row['country']=="USA") { echo "selected"; } ?>>
                USA
            </option>
        </select><br>

        Hobby:<br>
        <?php $hobbies = explode(", ", $row['hobby']); ?>
        <input type="checkbox" name="hobby[]" value="cricket"
            <?php if (in_array("cricket", $hobbies)) { echo "checked"; } ?>>
        Cricket<br>

        <input type="checkbox" name="hobby[]" value="chess"
            <?php if (in_array("chess", $hobbies)) { echo "checked"; } ?>>
        Chess<br>

        Profile Image:<br>
        <img src="upload/<?php echo $row['filenam']; ?>" width="100"><br>
        <input type="file" name="uploadfile"><br><br>

        <input type="submit" value="Update">

    </form>

</body>

</html>