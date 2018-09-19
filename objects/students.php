<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/16/2018
 * Time: 9:57 AM
 */

class students
{
    // database connection
    private $conn;
    private $table_name = "students";

    // objects properties
    public $student_id;
    public $user_id;
    public $gender;
    public $profile_image;
    public $birth_date;
    public $mobile;
    public $date_of_join;


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

    function uploadPhoto(){
        $result_message="";

        if($this->profile_image){
            //sha1_file() function is used to make a unique file name
            $target_directory = "uploads/";
            $target_file = $target_directory . $this->profile_image;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

            //error message is empty
            $file_upload_error_messages="";
            // make sure that file is a real img
            $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
            if($check !== false){
                // its img

            }   else{
                $file_upload_error_messages .=" <div> submitted file is not an img. </div>";
            }

            // make sure certain file types are allowed
            $allowed_file_types= array("jpg","jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages .=" <div> only JPG, JPEG, PNG, GIF files are allowed. </div>";
            }
            // make sure file does not exist
            if(file_exists($target_file)){
                $file_upload_error_messages .=" <div> Image already exists. try to change file name.</div>";
            }
            // make sure submitted file is not too large. can;t be larger than 1MB
            if($_FILES['profile_image']['size'] > (1024000)){
                $file_upload_error_messages .=" <div> img size must be less than 1 MB. </div>";
            }

            // make sure upload folder exists
            // if not create it
            if(!is_dir($target_directory)){
                mkdir($target_directory, 0777, true);
            }
            // if $file_upload_error_message is still empty
            if(empty($file_upload_error_messages)){
                // it means there are no errors, so try to upload the file
                if(move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)){
                    // it means photo was uploaded
                }
                else{
                    $result_message.= " <div class='alert alert-danger'>";
                    $result_message.= "<div> Unable to upload photo. </div>";
                    $result_message.= "<div> Update the record to upload photo. </div>";
                    $result_message.= " </div>";
                }

            }
            // if $file_upload_error_ message is not empty
            else {
                // it meas there are some errors, so show them to user
                $result_message .= " <div class='alert alert-danger'>";
                $result_message .="<div>{$file_upload_error_messages}</div>";
                $result_message .="<div> Update the record to upload photo. </div>";
                $result_message.="</div>";
            }


        }
        return $result_message;
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
                  SET  student_id=:student_id, user_id =:user_id, gender =:gender, profile_image =:profile_image, 
                  birth_date =:birth_date, mobile =:mobile, date_of_join =:date_of_join ";

        //prepare query for execution ,
        $stmt= $this->conn-> prepare($query);
        // posted values
        $this->student_id = htmlspecialchars(strip_tags($this->student_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->birth_date = htmlspecialchars(strip_tags($this->birth_date));
        $this->mobile = htmlspecialchars(strip_tags($this->mobile));
        $this->date_of_join = htmlspecialchars(strip_tags($this->date_of_join));
        $this->profile_image = htmlspecialchars(strip_tags($this->profile_image));

        // bind the parameters

        $stmt -> bindParam(":student_id", $this->student_id);
        $stmt -> bindParam(":user_id", $this->user_id);
        $stmt -> bindParam(":gender", $this->gender);
        $stmt -> bindParam(":birth_date", $this->birth_date);
        $stmt -> bindParam(":mobile", $this->mobile);
        $stmt -> bindParam(":date_of_join", $this->date_of_join);
        $stmt -> bindParam(":profile_image", $this->profile_image);

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