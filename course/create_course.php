<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 8/29/2018
 * Time: 11:13 PM
 */

require_once '../config/connection.php';
require_once '../objects/grades.php';
require_once '../objects/courses.php';

$conn = new Connection();
$db = $conn->getConnection();

//pass connection to database
$grade = new grades($db);
$course = new courses($db);

$page_title=" Create Course";

require_once '../header.php';
?>
<?php

    function checkInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

//if($_SERVER['REQUEST_METHOD'] == 'POST'){
//if(empty($_POST['course_name']) || empty($_POST['credit_hour']) || empty($_POST['grade_name'])){
//    $course_name_err = " Fill required field";
//}
//else{
//    $courses->course_name= checkInput($_POST['course_name']);
//    $courses->c = checkInput($_POST['credit_hour']);
//    $courses->grade_id = checkInput($_POST['grade_id']);
//}
    $course_name = $credit_hour = $grade_id= "";
    $course_name_err= $credit_hour_err = $grade_id_err = "";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(empty($_POST['course_name'])){
            $course_name_err = " Course Name is required";
        }
        else{
            $course->course_name= checkInput($_POST['course_name']);
        }
        if(empty($_POST['credit_hour'])){
            $credit_hour_err = "Credit Hour is required";
        }
        else{
            $course->credit_hour= checkInput($_POST['credit_hour']);
        }
        if(empty($_POST['grade_id'])){
            $grade_id_err = "Grade is required";
        }
        else {
            $course->grade_id = checkInput($_POST['grade_id']);
        }

        if($course->createCourse()){
            echo "<span class='alert alert-success'> courses created</span>";
        }
        else{
            echo "<span class='alert alert-danger'> filed to create courses</span>";
        }
}


?>
<div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">
        <a href="course/course_list.php" class=" btn btn-primary"><span class="fas fa-list" ></span>Course List</a>
        <a href="course/teacher_section.php" class=" btn btn-primary"><span class="fas fa-plus" ></span>Assign Teacher</a>
    </div>
</div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" METHOD="post" enctype="multipart/form-data">


    <table class="table table-hover table-responsive" style="padding-left: 400px">
        <tr>
            <td> Course Name</td>
            <td><input type="text" name="course_name" class="form-control" style="width: 400px"/><span class="error"> * <?php echo $course_name_err;?></span></td>
        </tr>
        <tr>
            <td> Credit Hour</td>
            <td ><input type="text" name="credit_hour" class="form-control"/><span class="error"> * <?php echo $credit_hour_err;?></span></td>
        </tr>
        <tr>
            <td> Grade</td>
            <td>
                <?php
                    $stmt = $grade->readGrade();
                    echo "<select class='form-control' name='grade_id' required>";
                        echo "<option class='error'>Select grades...</option>";
                        while($row_grade =$stmt->Fetch(PDO::FETCH_ASSOC)){
                            extract($row_grade);
                            echo "<option value='{$grade_id}'>{$grade_name}</option>";
                        }
                    echo "</select>";
                ?>
                <span class="error"> *</span>
            </td>
        </tr>
        <tr>
            <td> </td>
            <td>
                <input type="submit"  value="create" class="btn btn-primary fa-pull-right"/>
            </td>
        </tr>
    </table>
</form>
