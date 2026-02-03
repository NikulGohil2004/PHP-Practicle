<?php
class User {
    private $conn;
    private $table = "students";
    public function __construct($dbname) {
        $this->conn = $dbname;
    }
    public function create($firstName,$lastName, $email,$password,$addres,$phoneNumber,$gender,$country,$hobby,$image) {
        return $this->conn->query("INSERT INTO students (firstName,lastName,email,password,
                                    addres,phoneNumber,gender,country,hobby,filenam)
                                 VALUES ('$firstName','$lastName','$email','$password','$addres','$phoneNumber',
                                         '$gender','$country','$hobby','$image')");
    
        }

    public function read() {
        return $this->conn->query("SELECT * FROM students");
    }
    public function getById($id) {
        return $this->conn->query("SELECT * FROM students WHERE id=$id")->fetch_assoc();
    }
     public function update($id, $firstName, $lastName, $email,$password,$addres,$phoneNumber,$gender,$country,$hobby,$image) {
        return $this->conn->query("UPDATE `students` SET 
                                   firstName='$firstName', 
                                   lastName='$lastName',
                                   email='$email',
                                   password='$password',
                                   addres='$addres',
                                   phoneNumber='$phoneNumber',
                                   gender='$gender',
                                   country='$country',
                                   hobby='$hobby',
                                   filenam='$image' WHERE id='$id' ");    
    }

    public function delete($id) {
        return $this->conn->query("DELETE FROM students WHERE id=$id");
    }
}