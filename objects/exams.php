<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 8/30/2018
 * Time: 4:14 AM
 */

class exams
{
    private $conn;
    private $table_name = "exams";

    public $exam_id;
    public $course_id;
    public $exam_name;
    public $exam_description;
    public $exam_date;

    /**
     * exams constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function readExam(){
        $query = "select exam_id, exam_name from ".$this->table_name ."  order by exam_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function createExam(){

        $query = "Insert INTO " .$this->table_name ." 
                  SET course_id=:course_id, exam_name=:exam_name, exam_description=:exam_description, exam_date=:exam_date";

        //prepare query for execution ,
        $stmt= $this->conn-> prepare($query);
        // posted values
        $this->course_id = htmlspecialchars(strip_tags($this->course_id));
        $this->exam_name = htmlspecialchars(strip_tags($this->exam_name));
        $this->exam_description = htmlspecialchars(strip_tags($this->exam_description));
        $this->exam_date = htmlspecialchars(strip_tags($this->exam_date));

        // bind the parameters
        $stmt -> bindParam(":course_id", $this->course_id);
        $stmt -> bindParam(":exam_name",$this->exam_name);
        $stmt -> bindParam(":exam_description",$this->exam_description);
        $stmt -> bindParam(":exam_date",$this->exam_date);

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

