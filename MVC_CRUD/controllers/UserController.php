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
        $this->user->create($_POST['firstName'], $_POST['lastName'],$_POST['email'],
                            $_POST['password'],
                            $_POST['addres'],
                            $_POST['phoneNumber'],
                            $_POST['gender'],
                            $_POST['country'],
                            implode(", ", $_POST['hobby']),
                            );
        header("Location: index.php");
    }
    public function edit($id) {
        $data = $this->user->getById($id);
        include "views/Update.php";
    }
    public function update() {
          $firstName = trim($_POST['firstName']);
          $lastName = $_POST['lastName'];
          $email = $_POST['email'];
          $passwor = $_POST['password'];
          $addres= $_POST['addres'];
          $phoneNumber= $_POST['phoneNumber'];
          $gender = $_POST['gender'];
          $country = $_POST['country'];
          $hobby= isset($_POST['hobby']) && is_array($_POST['hobby']) 
             ? implode(", ", $_POST['hobby']) 
             : '';
        $this->user->update($firstName,$lastName, $email,$password,$addres,$phoneNumber,$gender,$country,$hobby,$id);
        header("Location: index.php");
    }
    public function delete($id) {
        $this->user->delete($id);
        header("Location: index.php");
    }
}
