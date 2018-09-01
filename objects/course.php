<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 8/29/2018
 * Time: 5:17 PM
 */


class course{
    private $conn;
    private $table_name = "course";

    public $course_id;
    public $course_name;
    public $credit_hour;
    public $grade_id;

    /**
     * course constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function readOne(){
        $query = "select course_name, credit_hour, grade_id from ".$this->table_name ." 
                    where course_id =? limit 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->course_id);
        $stmt->execute();
        $row = $stmt-> fetch(PDO::FETCH_ASSOC);

        $this->course_name = $row['course_name'];
        $this->credit_hour = $row['credit_hour'];
        $this->grade_id = $row['grade_id'];
    }
    function readCourse(){
        $query = "select course_id, course_name from ".$this->table_name ."  order by course_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function  readCourseName(){
        $query =" select first_name from " . $this->table_name . "where  staff_id = ? limit 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->staff_id);
        $stmt->execute();

        $row = $stmt-> fetch(PDO::FETCH_ASSOC);
        $this->first_name = $row['first_name'];
    }
    function readAll($from_record_num, $records_per_page){
        $query = "select course_id, course_name,credit_hour, grade_id 
                  from ".$this->table_name ." 
                  order by course_id ASC limit {$from_record_num}, {$records_per_page}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function countAll(){
        $query ="select course_id from " . $this->table_name . " ";
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
                    WHERE course_name LIKE ? OR credit_hour LIKE ? 
                    ORDER BY course_id ASC
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
                s.course_name LIKE ? OR s.credit_hour LIKE ? ";

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

    function createCourse(){

        $query = "Insert INTO " .$this->table_name ." 
                  SET course_name=:course_name, credit_hour=:credit_hour, grade_id=:grade_id";

        //prepare query for execution
        $stmt= $this->conn-> prepare($query);
        // posted values
        //$this->course_name = htmlspecialchars(strip_tags($this->course_name));
        //$this->credit_hour = htmlspecialchars(strip_tags($this->credit_hour));
        //$this->grade_id = htmlspecialchars(strip_tags($this->grade_id));

        // bind the parameters
        $stmt -> bindParam(":course_name", $this->course_name);
        $stmt -> bindParam(":credit_hour",$this->credit_hour);
        $stmt -> bindParam(":grade_id",$this->grade_id);

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
        $query = "UPDATE  ".$this->table_name ." 
                  SET  course_name=:course_name, credit_hour=:credit_hour, 
                       grade_id=:grade_id, course_id=:course_id
                   where 
                        course_id=:course_id";

        //prepare query for execution ,
        $stmt= $this->conn-> prepare($query);
        // posted values
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));
        $this->credit_hour = htmlspecialchars(strip_tags($this->credit_hour));
        $this->grade_id = htmlspecialchars(strip_tags($this->grade_id));
        $this->course_id = htmlspecialchars(strip_tags($this->course_id));

        // bind the parameters
        $stmt -> bindParam(":course_name", $this->course_name);
        $stmt -> bindParam(":credit_hour",$this->credit_hour);
        $stmt -> bindParam(":grade_id", $this->grade_id);
        $stmt -> bindParam(":course_id", $this->course_id);

        // specify when this record was inserted to the database
        // Execute the query
        if($stmt-> execute()){
            return true;
        }
        else{
            return false;
        }
    }

}

?>