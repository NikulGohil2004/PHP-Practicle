<?php
require_once "config/Database.php";
require_once "models/User.php";
class UserController {

    private $user;

    public function __construct() {
        $db = (new Database())->connect();
        $this->user = new User($db);
    }

    public function index() {
        $users = $this->user->read();
        include "views/Display.php";
    }
    public function add() {
        include "views/Add.php";
    }

   public function store() {

    $errors = [];

    $firstName = trim($_POST['firstName'] ?? '');
    $lastName  = trim($_POST['lastName'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $confirm   = $_POST['confirmPassword'] ?? '';
    $addres    = trim($_POST['addres'] ?? '');
    $phone     = trim($_POST['phoneNumber'] ?? '');
    $gender    = $_POST['gender'] ?? '';
    $country   = $_POST['country'] ?? '';
    $hobby     = isset($_POST['hobby']) ? implode(", ", $_POST['hobby']) : '';


    if ($firstName === '') {
        $errors[] = "First name is required";
    }

    if ($lastName === '') {
        $errors[] = "Last name is required";
    }

    if ($email === '') {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if ($password === '') {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    if ($confirm === '') {
        $errors[] = "Confirm password is required";
    } elseif ($password !== $confirm) {
        $errors[] = "Password and confirm password do not match";
    }elseif (!preg_match('/^[a-zA-Z0-9]{10}$/', $password)) {
    $errors[] = "Password must be exactly 10 characters and contain only letters and numbers.";
     }

    if ($addres === '') {
        $errors[] = "Address is required";
    }

    if ($phone === '') {
        $errors[] = "Phone number is required";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $errors[] = "Phone number must be 10 digits";
    }

    if ($gender === '') {
        $errors[] = "Gender is required";
    }

    if ($country === '') {
        $errors[] = "Country is required";
    }

    if ($hobby === '') {
        $errors[] = "At least one hobby is required";
    }
    
    $image = "";

    if (empty($_FILES['uploadfile']['name'])) {
        $errors[] = "Profile image is required";
    } else {
        $allowed = ['jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            $errors[] = "Only JPG, JPEG, PNG images are allowed";
        }
    }



    if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header("Location: index.php?action=add");
    exit;
}



    $image = time() . "_" . $_FILES['uploadfile']['name'];
    move_uploaded_file($_FILES['uploadfile']['tmp_name'], "upload/" . $image);



    $this->user->create(
        $firstName,
        $lastName,
        $email,
        $password,
        $addres,
        $phone,
        $gender,
        $country,
        $hobby,
        $image
    );

    header("Location: index.php");
    exit;
}



    public function edit($id) {
        $data = $this->user->getById($id);
        include "views/Update.php";
    }


 public function update($id) {

    $errors = [];

    $data = $this->user->getById($id);

    $firstName = trim($_POST['firstName'] ?? '');
    $lastName  = trim($_POST['lastName'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $addres    = trim($_POST['addres'] ?? '');
    $phone     = trim($_POST['phoneNumber'] ?? '');
    $gender    = $_POST['gender'] ?? '';
    $country   = $_POST['country'] ?? '';
    $hobbyArr  = $_POST['hobby'] ?? [];
    $hobby     = implode(", ", $hobbyArr);



    if ($firstName === '') {
        $errors[] = "First name is required";
    }

    if ($lastName === '') {
        $errors[] = "Last name is required";
    }

    if ($email === '') {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }


    if ($password === '') {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }elseif(!preg_match( '/^[a-zA-Z0-9]+$/' , $password)) {
    $errors[] = 'Password can only contain letters and numbers.';
}

    if ($addres === '') {
        $errors[] = "Address is required";
    }

    if ($phone === '') {
        $errors[] = "Phone number is required";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $errors[] = "Phone number must be 10 digits";
    }

    if ($gender === '') {
        $errors[] = "Gender is required";
    }

    if ($country === '') {
        $errors[] = "Country is required";
    }

    if (empty($hobbyArr)) {
        $errors[] = "At least one hobby is required";
    }


    if ($password === '') {
        $password = $data['password'];
    }


    $image = $data['filenam'];

    if (!empty($_FILES['uploadfile']['name'])) {

        $allowed = ['jpg','jpeg','png'];
        $ext = strtolower(pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            $errors[] = "Only JPG, JPEG, PNG images are allowed";
        }
    }


    if (!empty($errors)) {

        $_SESSION['errors'] = $errors;
        $_SESSION['old']    = $_POST;

        header("Location: index.php?action=edit&id=".$id);
        exit;
    }


    if (!empty($_FILES['uploadfile']['name'])) {

        if ($image && file_exists("upload/".$image)) {
            unlink("upload/".$image);
        }

        $image = time() . "_" . $_FILES['uploadfile']['name'];
        move_uploaded_file($_FILES['uploadfile']['tmp_name'], "upload/".$image);
    }

 
    $this->user->update(
        $id,
        $firstName,
        $lastName,
        $email,
        $password,
        $addres,
        $phone,
        $gender,
        $country,
        $hobby,
        $image
    );

    header("Location: index.php");
    exit;
}


    public function delete($id) {

        $user = $this->user->getById($id);

        if ($user['filenam'] && file_exists("upload/" . $user['filenam'])) {
            unlink("upload/" . $user['filenam']);
        }

        $this->user->delete($id);

        header("Location: index.php");
        exit;
    }
}