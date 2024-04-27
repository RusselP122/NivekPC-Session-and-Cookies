<?php

class Database {
 
    private $server = "mysql:host=localhost;dbname=nivekpc"; // Update the database name if needed
    private $username = "root"; // Update the username if needed
    private $password = ""; // Update the password if needed
    private $options  = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );
    protected $conn;
    
    public function open() {
        try {
            $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
            return $this->conn;
        } catch (PDOException $e) {
            // Output error message and halt execution if connection fails
            die("Connection failed: " . $e->getMessage());
        }
    }
 
    public function close() {
        // Close the database connection
        $this->conn = null;
    }
 
}

// Create a new instance of the Database class
$database = new Database();

// Open a connection to the database
$pdo = $database->open();

