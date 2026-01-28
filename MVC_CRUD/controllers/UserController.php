<?php
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
        $image = "";
        if (!empty($_FILES['uploadfile']['name'])) {
            $image = time().'_'.$_FILES['uploadfile']['name'];
            move_uploaded_file($_FILES['uploadfile']['tmp_name'], 'upload/'.$image);
        }

        $hobby = isset($_POST['hobby']) ? implode(", ", $_POST['hobby']) : "";

        $this->user->create(
            $_POST['firstName'],$_POST['lastName'],$_POST['email'],
            $_POST['password'],$_POST['addres'],$_POST['phoneNumber'],
            $_POST['gender'],$_POST['country'],$hobby,$image
        );
        header("Location: index.php");
    }
    public function edit($id) {
        $data = $this->user->getById($id);
        include "views/Update.php";
    }
    public function update($id) {
          $id = $_POST['id'];
          $firstName = trim($_POST['firstName']);
          $lastName = $_POST['lastName'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $addres= $_POST['addres'];
          $phoneNumber= $_POST['phoneNumber'];
          $gender = $_POST['gender'];
          $country = $_POST['country'];
          $hobby = implode(", ", $_POST['hobby']);
          $image = $_FILES['uploadfile']['name'];
          $location = "upload/".$image;
    
          if(!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $location) ) { 
             echo '<p>The php and HTML5 file upload failed. Error code: ' . $_FILES['uploadfile']['error'] . '</p>'; 
            }
         
            
        $this->user->update($id,$firstName,$lastName, $email,$password,$addres,$phoneNumber,$gender,$country,$hobby,$image);
        
        header("Location: index.php");
     
    }
    public function delete($id) {
        $this->user->delete($id);
        header("Location: index.php");
    }
}
