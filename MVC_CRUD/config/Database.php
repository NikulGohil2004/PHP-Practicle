<?php
class Database {
    private $host = "localhost";
    private $db   = "user";
    private $user = "root";
    private $pass = "admin123";
    public $conn;
    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Database connection failed");
        }
        return $this->conn;
    }
}
