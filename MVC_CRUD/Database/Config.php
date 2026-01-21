
<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "admin123";
    private $dbname = "user";
    public $con;

    // Constructor automatically runs when the class is instantiated
    public function __construct() {
        $this->connect();
    }

    private function connect() {
        // Create connection using the mysqli object-oriented interface
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }else{
            echo "successfully connected";
        }
    }
}

// Usage:
$db = new Database();
$con = $db->con; // This is your active connection object
?>