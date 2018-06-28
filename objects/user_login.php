<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/20/2018
 * Time: 7:25 AM
 */
class user_login{
    // database connection
    private $conn;
    private $table_name = "user_login";

    // objects properties
    public $user_login_id;
    public $user_name;
    public $email;
    public $password;
    public $status;
    public $user_role;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login(){
        $query = "select user_login_id, password from ".$this->table_name." where user_name= ?";
        $stmt = $this->conn->prepare($query);
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $stmt-> bindParam(1, $this->user_name);
        $stmt->execute();
        return $stmt;
    }
    public function countAll(){
        $query ="select user_login_id from " . $this->table_name . " ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();
        return $num;
    }
}
?>