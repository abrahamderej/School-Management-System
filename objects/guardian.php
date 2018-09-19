<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 9/19/2018
 * Time: 1:59 AM
 */

class guardian
{
    // database connection
    private $conn;
    private $table_name = "parents";

    // objects properties
    public $parent_id;
    public $user_id;
    public $parent_type;
    public $mobile;
    public $telephone;
    public $work_place;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    // used by select drop down list ---you have get user.user_id == staff.user_id---
    function read(){
        // select all data
        $query = "select staff_id, first_name
                from
                ". $this ->table_name. "
                order by first_name";
        $stmt = $this ->conn-> prepare($query);
        $stmt ->execute();

        return $stmt;
    }

    function  readName(){
        $query =" select first_name from " . $this->table_name . "where  staff_id = ? limit 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->staff_id);
        $stmt->execute();

        $row = $stmt-> featch(PDO::FETCH_ASSOC);
        $this->first_name = $row['first_name'];
    }

    function readAll($from_record_num, $records_per_page){
        $query = "Select staff_id, user_id, gender, profile_image, job_title, mobile, telephone
        from 
        " .$this->table_name ." order by user_id.last_name ASC 
        limit {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readOne(){
        $query = "Select gender, profile_image, job_title, email, mobile, telephone
        from 
        " .$this->table_name ."
        where staff_id = ? 
        limit 0, 1";

        $stmt = $this->conn->prepare($query);
        $stmt-> bindParam(1,$this->staff_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this ->gender = $row['gender'];
        $this ->job_title = $row['job_title'];
        $this ->mobile = $row['mobile'];
        $this ->telephone = $row['telephone'];
        $this ->profile_image = $row['profile_image'];

    }

    public function countAll(){
        $query ="select staff_id from " . $this->table_name . " ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();
        return $num;
    }
    //read products by search term
    public function search($search_term, $from_record_num, $records_per_page){

        // select query
        $query = "SELECT *
                    FROM " . $this->table_name . " 
                    WHERE last_name LIKE ? OR first_name LIKE ?
                    ORDER BY first_name ASC
                    LIMIT ?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }

    public function countAll_BySearch($search_term){

        // select query
        $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . " s 
            WHERE
                s.last_name LIKE ? OR s.first_name LIKE ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    function create(){

        $query = "Insert INTO " .$this->table_name ." 
                  SET  parent_id=:parent_id, user_id =:user_id, parent_type =:parent_type, 
                  telephone =:telephone, mobile =:mobile, work_place =:work_place ";

        //prepare query for execution ,
        $stmt= $this->conn-> prepare($query);
        // posted values
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->parent_type = htmlspecialchars(strip_tags($this->parent_type));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->telephone = htmlspecialchars(strip_tags($this->telephone));
        $this->work_place = htmlspecialchars(strip_tags($this->work_place));

        // bind the parameters

        $stmt -> bindParam(":parent_id", $this->parent_id);
        $stmt -> bindParam(":user_id", $this->user_id);
        $stmt -> bindParam(":parent_type", $this->parent_type);
        $stmt -> bindParam(":mobile", $this->mobile);
        $stmt -> bindParam(":telephone", $this->telephone);
        $stmt -> bindParam(":work_place", $this->work_place);

        // specify when this record was inserted to the database
        // Execute the query
        if($stmt-> execute()){
            return true;
        }
        else{
            return false;
        }
    }
    function update(){

        $query = " UPDATE  " .$this->table_name ." 
                  SET  user_id=:user_id, gender=:gender, profile_image=:profile_image, job_title=:job_title,
                       mobile=:mobile, telephone=:telephone 
                   where 
                        staff_id=:staff_id";

        //prepare query for execution ,
        $stmt= $this->conn-> prepare($query);
        // posted values
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->job_title = htmlspecialchars(strip_tags($this->job_title));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->telephone = htmlspecialchars(strip_tags($this->telephone));
        $this->staff_id = htmlspecialchars(strip_tags($this->staff_id));
        $this->profile_image = htmlspecialchars(strip_tags($this->profile_image));

        // bind the parameters
        $stmt -> bindParam(":user_id", $this->user_id);
        $stmt -> bindParam(":gender", $this->gender);
        $stmt -> bindParam(":job_title", $this->job_title);
        $stmt -> bindParam(":mobile", $this->mobile);
        $stmt -> bindParam(":telephone", $this->telephone);
        $stmt -> bindParam(":profile_image", $this->profile_image);
        $stmt -> bindParam(":staff_id", $this->staff_id);

        // specify when this record was inserted to the database
        // Execute the query
        if($stmt-> execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function delete(){
        $query = "delete from ".$this->table_name." where staff_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt-> bindParam(1, $this->staff_id);

        if($result= $stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}