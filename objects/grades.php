<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 8/29/2018
 * Time: 12:53 AM
 */

class grades{
    private $conn;
    private $table_name = "grades";

    public $grade_id;
    public $grade_name;
    public $description;

    /**
     * grades constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function readGrade(){
        $query = "select grade_id, grade_name, description from ".$this->table_name ."  order by grade_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function  readGradeName(){
        $query =" select grade_name from " . $this->table_name . " where  grade_id = ? limit 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->grade_id);
        $stmt->execute();

        $row = $stmt-> fetch(PDO::FETCH_ASSOC);
        $this->grade_name = $row['grade_name'];
    }

    function createGrade(){

        $query = "Insert INTO " .$this->table_name ." 
                  SET  grade_name=:grade_name, description=:description ";

        //prepare query for execution ,
        $stmt= $this->conn-> prepare($query);
        // posted values
        $this->grade_name = htmlspecialchars(strip_tags($this->grade_name));
        $this->description = htmlspecialchars(strip_tags($this->description));

        // bind the parameters
        $stmt -> bindParam(":grade_name", $this->grade_name);
        $stmt -> bindParam(":description",$this->description);

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