<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/17/2018
 * Time: 3:52 AM
 */

$course_id = isset($_GET['course_id']) ? $_GET['course_id']: die('Error : missing ID');
//include database and objects files
include_once '../config/connection.php';
include_once '../objects/courses.php';
include_once '../objects/grades.php';

// get database connection
$connection = new Connection();
$db = $connection->getConnection();

// pass connection to objects and prepare object
$course = new courses($db);
$grade = new grades($db);

// set id of staffs to be edited
$course->course_id= $course_id;

// read the details of staffs
$course->readOne();
$page_title = "Update courses";
include_once "../header.php";

?>
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <a href="course/course_list.php" class=" btn btn-primary"><span class="fas fa-list" ></span>Course List</a><ln/>
            <a href="course/teacher_section.php" class=" btn btn-primary"><span class="fas fa-plus" ></span>Assign Teacher</a></div>
    </div>
<?php
if($_POST){

    // set staffs property values
    $course ->course_name = $_POST['course_name'];
    $course ->credit_hour = $_POST['credit_hour'];
    $course ->grade_id = $_POST['grade_id'];
    // update the staffs
    if($course -> update()){
        echo "<div class='alert alert-success alert-dismissible'> courses Successful updated</div>";
        header('Location: course_list.php');
    }
    else{
        echo "<div class='alert alert-danger alert-dismissible'> Unable to update courses </div>";
    }

}
?>
    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?course_id={$course_id}");?>" METHOD="post">

        <table class="table table-hover table-responsive" style="width: 1000px; padding-left: 400px">
            <tr>
                <td> Course Name</td>
                <td><input type="text" name="course_name" value="<?php echo $course->course_name?>" class="form-control" style="width: 400px"/></td>
            </tr>
            <tr>
                <td> Credit Hour</td>
                <td ><input type="text" name="credit_hour" value="<?php echo $course->credit_hour?>" class="form-control"/></td>
            </tr>
            <tr>
                <td> Grade</td>
                <td>
                    <?php
                    $stmt = $grade->readGrade();
                    echo "<select class='form-control' name='grade_id'>";
                    echo "<option >Select grades...</option>";
                    while($row_grade =$stmt->fetch(PDO::FETCH_ASSOC)){
                        $grade_id = $row_grade['grade_id'];
                        $grade_name = $row_grade['grade_name'];
                        if($course->grade_id == $grade_id){
                            echo "<option value='{$grade_id}' selected>";
                        }
                        else{
                            echo "<option value='{$grade_id}'>";
                        }
                        echo "$grade_name</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Update" class="btn btn-primary"/>
                </td>
            </tr>

        </table>

    </form>
<?
include_once "../footer.php";
?>