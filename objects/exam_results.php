<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 8/30/2018
 * Time: 4:24 AM
 */

class exam_results{

    private $conn;
    private $table_name = "exam_results";

    public $result_id;
    public $exam_id;
    public $exam_value;

    /**
     * exam_results constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function createExamResult(){

        $query = "Insert INTO " .$this->table_name ." 
                  SET exam_id=:exam_id, exam_value=:exam_value";

        //prepare query for execution ,
        $stmt= $this->conn-> prepare($query);
        // posted values
        $this->exam_id = htmlspecialchars(strip_tags($this->exam_id));
        $this->exam_value = htmlspecialchars(strip_tags($this->exam_value));

        // bind the parameters
        $stmt -> bindParam(":exam_id", $this->exam_id);
        $stmt -> bindParam(":exam_value",$this->exam_value);

        // Execute the query
        if($stmt-> execute()){
            return true;
        }
        else{
            return false;
        }
    }

}

