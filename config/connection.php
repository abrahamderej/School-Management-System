<?php

class Connection{
    //specify database credentials

    private $host='localhost';
    private $db_name='school';
    private $username = 'root';
    private $password='';
    public $conn;
// get the database connection
    public function getConnection(){
        $this -> conn= null;

        try{
            $this ->conn = new PDO("mysql:host =" .$this->host ."; dbname=" .$this->db_name, $this->username, $this->password);
        }
        catch (PDOException $exception) {
            echo "Connection error : " . $exception->getMessage();
        }
        return $this->conn;
    }
    public function beginTransaction(){
        return $this->conn->beginTransaction();
    }
    public function commit(){
        return $this->conn->commit();
    }
 }
?>