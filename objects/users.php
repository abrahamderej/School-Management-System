<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/20/2018
 * Time: 7:25 AM
 */
class users{
    // database connection
    private $conn;
    private $table_name = "users";

    public $user_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $user_name;
    public $email;
    public $password;
    public $address;
    public $access_level;
    public $access_code;
    public $status;
    public $created;
    public $modified;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // check if given email exist in the database
    function emailExists(){

        // query to check if email exists
        $query = "SELECT user_id, first_name, last_name, access_level, password, status
			FROM " . $this->table_name . "
			WHERE email = ?
			LIMIT 0,1";

        // prepare the query
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));

        // bind given email value
        $stmt->bindParam(1, $this->email);

        // execute the query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){

            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // assign values to object properties
            $this->user_id = $row['user_id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->access_level = $row['access_level'];
            $this->password = $row['password'];
            $this->status = $row['status'];

            // return true because email exists in the database
            return true;
        }

        // return false if email does not exist in the database
        return false;
    }

    // check if given access_code exist in the database
    function accessCodeExists(){

        // query to check if access_code exists
        $query = "SELECT user_id
			FROM " . $this->table_name . "
			WHERE access_code = ?
			LIMIT 0,1";

        // prepare the query
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->access_code=htmlspecialchars(strip_tags($this->access_code));

        // bind given access_code value
        $stmt->bindParam(1, $this->access_code);

        // execute the query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // if access_code exists
        if($num>0){

            // return true because access_code exists in the database
            return true;
        }

        // return false if access_code does not exist in the database
        return false;

    }

// used in email verification feature
    function updateStatusByAccessCode(){

        // update query
        $query = "UPDATE " . $this->table_name . "
			SET status = :status
			WHERE access_code = :access_code";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->access_code=htmlspecialchars(strip_tags($this->access_code));

        // bind the values from the form
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':access_code', $this->access_code);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
// used in forgot password feature
    function updateAccessCode(){

        // update query
        $query = "UPDATE
				" . $this->table_name . "
			SET
				access_code = :access_code
			WHERE
				email = :email";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->access_code=htmlspecialchars(strip_tags($this->access_code));
        $this->email=htmlspecialchars(strip_tags($this->email));

        // bind the values from the form
        $stmt->bindParam(':access_code', $this->access_code);
        $stmt->bindParam(':email', $this->email);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }
// used in forgot password feature
    function updatePassword(){

        // update query
        $query = "UPDATE " . $this->table_name . "
			SET password = :password
			WHERE access_code = :access_code";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->access_code=htmlspecialchars(strip_tags($this->access_code));

        // bind the values from the form
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':access_code', $this->access_code);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function  readName(){
        $query =" select first_name from " . $this->table_name . "where  user_id = ? limit 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();

        $row = $stmt-> fetch(PDO::FETCH_ASSOC);
        $this->first_name = $row['first_name'];
    }
    function readOne(){
        $query = "Select first_name, last_name, middle_name, user_name, email, address
        from 
        " .$this->table_name ."
        where user_id = ? 
        limit 0, 1";

        $stmt = $this->conn->prepare($query);
        $stmt-> bindParam(1,$this->user_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->first_name = $row['first_name'];
        $this->middle_name = $row['middle_name'];
        $this->last_name = $row['last_name'];
        $this->user_name = $row['user_name'];
        $this->email = $row['email'];
        $this->address = $row['address'];

    }
    // read all user records
    function readAll($from_record_num, $records_per_page){

        // query to read all user records, with limit clause for pagination
        $query = "SELECT
				user_id, first_name, middle_name, last_name, user_name,
				email, address, access_level,access_code, created
			FROM " . $this->table_name . "
			ORDER BY user_id DESC
			LIMIT ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind limit clause variables
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values
        return $stmt;
    }

    public function countAll(){
        $query ="select user_login_id from " . $this->table_name . " ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();
        return $num;
    }
    // create new user record
    function create(){

        //$this->conn->beginTransaction();
        // to get time stamp for 'created' field
        $this->created=date('Y-m-d H:i:s');

        // insert query
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
				first_name =:first_name, middle_name =:middle_name,
				last_name =:last_name, user_name =:user_name,
				email =:email, password =:password, address =:address,				
				access_level =:access_level, access_code =:access_code,
				status =:status, created =:created";

        // prepare the query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->first_name=htmlspecialchars(strip_tags($this->first_name));
        $this->middle_name=htmlspecialchars(strip_tags($this->middle_name));
        $this->last_name=htmlspecialchars(strip_tags($this->last_name));
        $this->user_name=htmlspecialchars(strip_tags($this->user_name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->access_level=htmlspecialchars(strip_tags($this->access_level));
        $this->access_code=htmlspecialchars(strip_tags($this->access_code));
        $this->status=htmlspecialchars(strip_tags($this->status));

        // bind the values
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':middle_name', $this->middle_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':user_name', $this->user_name);
        $stmt->bindParam(':email', $this->email);

        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);

        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':access_level', $this->access_level);
        $stmt->bindParam(':access_code', $this->access_code);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':created', $this->created);
        if($stmt->execute()){
            $_SESSION['new_user_id']=$this->conn->lastInsertId();
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    }
    public function  userID(){
        return  $_SESSION['new_user_id'];
    }

    public function showError($stmt){
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }


}
?>