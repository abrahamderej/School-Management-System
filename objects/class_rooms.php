<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 8/30/2018
 * Time: 12:32 AM
 */

class class_rooms
{
    private $conn;
    private $table_name = "class_rooms";

    public $class_room_id;
    public $teacher_id;
    public $grade_id;
    public $class_year;
    public $section;
    public $remarks;

    /**
     * class_rooms constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function assignTeacher(){

        $query = "Insert INTO " .$this->table_name ." 
                  SET teacher_id=:teacher_id, grade_id=:grade_id, class_year=:class_year, section=:section, remarks=:remarks";

        //prepare query for execution ,
        $stmt= $this->conn-> prepare($query);
        // posted values
        $this->teacher_id = htmlspecialchars(strip_tags($this->teacher_id));
        $this->grade_id = htmlspecialchars(strip_tags($this->grade_id));
        $this->class_year = htmlspecialchars(strip_tags($this->class_year));
        $this->section = htmlspecialchars(strip_tags($this->section));
        $this->remarks = htmlspecialchars(strip_tags($this->remarks));

        // bind the parameters
        $stmt -> bindParam(":teacher_id", $this->teacher_id);
        $stmt -> bindParam(":grade_id",$this->grade_id);
        $stmt -> bindParam(":class_year",$this->class_year);
        $stmt -> bindParam(":section",$this->section);
        $stmt -> bindParam(":remarks",$this->remarks);

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

