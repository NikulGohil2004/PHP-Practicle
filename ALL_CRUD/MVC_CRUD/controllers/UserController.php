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
       
          $firstName = trim($_POST['firstName']);
          $lastName = $_POST['lastName'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $confirmPassword = $_POST['confirmPassword'];
          $addres= $_POST['addres'];
          $phoneNumber= $_POST['phoneNumber'];
          $gender = $_POST['gender'];
          $country = $_POST['country'];
          $hobby = isset($_POST['hobby']) ? implode(", ", $_POST['hobby']) : "";
          $image = "";
          if (!empty($_FILES['uploadfile']['name'])) {
            $image = time().'_'.$_FILES['uploadfile']['name'];
            move_uploaded_file($_FILES['uploadfile']['tmp_name'], 'upload/'.$image);
          }
     

          if($firstName==""){
             echo "<script>alert('FirstName is required')</script>";
          }elseif($lastName==""){
            echo "<script>alert('LastName is required')</script>";
          }elseif($email==""){
            echo "<script>alert('Email is required')</script>";
          }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             echo "<script>alert('Format is invalid. ->  EX. nikulgohil4508@gmail.com')</script>";
          }elseif ($password=="") {
             echo "<script>alert('Password is required')</script>";
          }elseif (!(strlen($password) > 6)){
            echo "<script>alert('Password length must be more than 6')</script>";
          }elseif (!preg_match('/[a-zA-Z]/', $password)) {
            echo "<script>alert('Password contains letter')</script>";
          }elseif (!preg_match('/[\W_]/', $password)) {
            echo "<script>alert('Password contains One Special Charcater.')</script>";
          }elseif ($confirmPassword=="") {
            echo "<script>alert('Confirm password is required')</script>";
          }elseif ($password !== $confirmPassword) {
            echo "<script>alert('Password and Confirm-Password does not match')</script>";
          }elseif($addres==""){
            echo "<script>alert('Address is required')</script>";
          }elseif ($phoneNumber=="") {
            echo "<script>alert('Phone-Number is required')</script>";
          }elseif(!(strlen($phoneNumber) == 10)){
            echo "<script>alert('Phone-Number is Must 10 DIGIT')</script>";
          }elseif ($gender=="") {
            echo "<scipt>alert('Gender is required')</script>";
          }elseif ($country=="") {
            echo "<script>alert('country is required')</script>";
          }elseif ($hobby=="") {
             echo "<script>alert('hobby is required')</script>";
          }elseif($image==""){
            echo "<script>alert('Image is required to upload')</script>";
          }
          else{

          $this->user->create($firstName,$lastName, $email,$password,$addres,
                             $phoneNumber,$gender,$country,$hobby,$image
                             );
         header("Location: index.php");
          }
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
