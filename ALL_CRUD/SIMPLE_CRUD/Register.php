<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>

</head>

<body>

    <form method="post" action="Insert.php" enctype="multipart/form-data">

        <label for="name">FirstName:</label>
        <input type="text" name="firstName"><br>

        <label>Last-Name:-</label>
        <input type="text" name="lastName" required /><br>

        <label>Email:-</label>
        <input type="email" name="email" required /><br>

        <label>Password:-</label>
        <input type="password" name="password" required /><br>

        <label>Confirm-password:-</label>
        <input type="password" name="confirmPassword" required /><br>

        <label>Address:-</label>
        <textarea name="addres" required></textarea><br>

        <label>Phone-No:-</label>
        <input type="number" name="phoneNumber" required /><br>

        <label>Gender:-</label><br>
        Male:<input type="radio" name="gender" value="male" checked /><br>
        Female:<input type="radio" name="gender" value="female" /><br>

        <label for="category">Select Country:</label>
        <select name="country" required>
            <option value="India">India</option>
            <option value="Usa">USA</option>
        </select><br>

        <label>Hobby:-</label><br>
        <input type="checkbox" name=hobby[] value="cricket" required />cricket<br>
        <input type="checkbox" name=hobby[] value="chess" />chess<br>


        <label>Profile-Image:-</label>
        <input type="file" name="uploadfile" value="" required /><br>

        <input type="submit" name="submit" value="submit" />
    </form>

</body>

</html>