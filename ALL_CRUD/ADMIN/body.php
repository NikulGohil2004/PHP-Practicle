<!-- <?php
require_once "config/Database.php";
require_once "models/User.php";

class UserController {
    private $user;

    public function __construct() {
        $dbname = (new Database())->connect();
        $this->user = new User($dbname);
    }

    public function index() {
        $users = $this->user->read();
        include "views/Display.php";
    }

    public function store() {

        $errors = [];

        $firstName = trim($_POST['firstName']);
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $addres = $_POST['addres'];
        $phoneNumber = $_POST['phoneNumber'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $hobby = isset($_POST['hobby']) ? implode(", ", $_POST['hobby']) : "";

        $image = "";
        if (!empty($_FILES['uploadfile']['name'])) {
            $image = time().'_'.$_FILES['uploadfile']['name'];
            move_uploaded_file($_FILES['uploadfile']['tmp_name'], 'upload/'.$image);
        }

        if ($firstName == "") $errors[] = "First name is required";
        if ($lastName == "") $errors[] = "Last name is required";
        if ($email == "") $errors[] = "Email is required";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
        if ($password == "") $errors[] = "Password is required";
        if (strlen($password) <= 6) $errors[] = "Password must be more than 6 characters";
        if (!preg_match('/[a-zA-Z]/', $password)) $errors[] = "Password must contain letters";
        if (!preg_match('/[\W_]/', $password)) $errors[] = "Password must contain a special character";
        if ($confirmPassword == "") $errors[] = "Confirm password is required";
        if ($password !== $confirmPassword) $errors[] = "Passwords do not match";
        if ($addres == "") $errors[] = "Address is required";
        if ($phoneNumber == "") $errors[] = "Phone number is required";
        if (strlen($phoneNumber) != 10) $errors[] = "Phone number must be 10 digits";
        if ($gender == "") $errors[] = "Gender is required";
        if ($country == "") $errors[] = "Country is required";
        if ($hobby == "") $errors[] = "Hobby is required";
        if ($image == "") $errors[] = "Image upload is required";

        if (!empty($errors)) {
            include "views/Create.php";
            return;
        }

        $this->user->create(
            $firstName,
            $lastName,
            $email,
            $password,
            $addres,
            $phoneNumber,
            $gender,
            $country,
            $hobby,
            $image
        );

        header("Location: index.php");
    }

    public function edit($id) {
        $data = $this->user->getById($id);
        include "views/Update.php";
    }

    public function update($id) {

        $errors = [];

        $id = $_POST['id'];
        $firstName = trim($_POST['firstName']);
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $addres = $_POST['addres'];
        $phoneNumber = $_POST['phoneNumber'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $hobby = implode(", ", $_POST['hobby']);

        $image = $_FILES['uploadfile']['name'];
        if (!empty($image)) {
            move_uploaded_file($_FILES['uploadfile']['tmp_name'], "upload/".$image);
        }

        if ($firstName == "") $errors[] = "First name is required";
        if ($email == "") $errors[] = "Email is required";

        if (!empty($errors)) {
            $data = $this->user->getById($id);
            include "views/Update.php";
            return;
        }

        $this->user->update(
            $id,
            $firstName,
            $lastName,
            $email,
            $password,
            $addres,
            $phoneNumber,
            $gender,
            $country,
            $hobby,
            $image
        );

        header("Location: index.php");
    }

    public function delete($id) {
        $this->user->delete($id);
        header("Location: index.php");
    }
}



/// header

