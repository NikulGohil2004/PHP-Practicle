<?php
class User {
    private $conn;
    private $table = "student";
    public function __construct($dbname) {
        $this->conn = $dbname;
    }
    public function create($firstName,$lastName, $email,$password,$addres,$phoneNumber,$gender,$country,$hobby) {
        return $this->conn->query("INSERT INTO student (firstName,lastName,email,password,
                                    addres,phoneNumber,gender,country,hobby,filenam)
                                 VALUES ('$firstName','$lastName','$email','$password','$addres','$phoneNumber',
                                         '$gender','$country','$hobby','$filenam')");
    }
    public function read() {
        return $this->conn->query("SELECT * FROM student");
    }
    public function getById($id) {
        return $this->conn->query("SELECT * FROM student WHERE id=$id")->fetch_assoc();
    }
    public function update($firstName,$lastName, $email,$password,$addres,$phoneNumber,$gender,$country,$hobby) {
        return $this->conn->query("UPDATE student SET firstName='$firstName', lastName='$lastName', email='$email',
                                 password='$password',addres='$addres',phoneNumber='$phoneNumber',
                                 gender='$gender',country='$country',hobby='$hobby',filenam='$filenam' WHERE id='$id'") or die("not executed");
    
    }
    public function delete($id) {
        return $this->conn->query("DELETE FROM student WHERE id=$id");
    }
}