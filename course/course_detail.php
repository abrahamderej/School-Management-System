<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/17/2018
 * Time: 7:19 AM
 */
$course_id = isset($_GET['course_id']) ? $_GET['course_id']: die('Error : missing ID');
//include database and objects files
include_once '../config/connection.php';
include_once '../objects/course.php';
include_once '../objects/grade.php';

// get database connection
$connection = new Connection();
$db = $connection->getConnection();

// pass connection to objects and prepare object
$course = new course($db);
$grade = new grade($db);
// set id of course to be edited
$course->course_id= $course_id;
// read the details of course
$course->readOne();
$page_title = "course detail";
include_once "../header.php";
?>
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <a href="course/course_list.php" class=" btn btn-primary"><span class="fas fa-list" ></span>Course List</a><ln/>
            <a href="course/teacher_section.php" class=" btn btn-primary"><span class="fas fa-plus" ></span>Assign Teacher</a></div>
    </div>

    <table class="table table-hover table-responsive" style="padding-left: 250px;">
        <tr>
            <td> Course Name</td>
            <td><?php echo $course->course_name;?></td>
        </tr>
        <tr>
            <td> Credit Hour</td>
            <td><?php echo $course->credit_hour ?></td>
        </tr>
        <tr>
            <td> Grade</td>
            <td><?php
                    $stmt = $grade-> readGrade();
                    while($row_grade = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $grade_id = $row_grade['grade_id'];
                        $grade_name = $row_grade['grade_name'];
                        $description = $row_grade['description'];
                        if($course->grade_id == $grade_id){
                            echo "$grade_name </br>";
                            echo "$description";
                        }
                    }
                    ?>
            </td>
        </tr>
    </table>

<?php
include_once "../footer.php";

?>