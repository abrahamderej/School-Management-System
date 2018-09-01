<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 8/29/2018
 * Time: 11:13 PM
 */

require_once '../config/connection.php';
require_once '../objects/exam.php';
require_once '../objects/course.php';

$conn = new Connection();
$db = $conn->getConnection();

//pass connection to database
$exam = new exam($db);
$course = new course($db);

$page_title="create exam";

require_once '../header.php';
?>
<?php
if($_POST){

    $exam->course_id = $_POST['course_id'];
    $exam->exam_name = $_POST['exam_name'];
    $exam->exam_description = $_POST['exam_description'];

    if($exam->createExam()){
        echo "<div class='alert alert-success'> course created</div>";
    }
    else{
        echo "<div class='alert alert-danger'> filed to create course</div>";
    }
}


?>
<a href="course/teacher_section.php" class="fa-pull-right btn btn-primary"><span class="fas fa-plus" ></span>Assign Teacher</a>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" METHOD="post" enctype="multipart/form-data">

    <table class="table table-hover table-responsive" style="padding-left: 400px">
        <tr>
            <td> Course</td>
            <td>
                <?php
                $stmt = $course->readCourse();
                echo "<select class='form-control' name='course_id'>";
                echo "<option >Select Course...</option>";
                while($row_course =$stmt->Fetch(PDO::FETCH_ASSOC)){
                    extract($row_course);
                    echo "<option value='{$course_id}'>{$course_name}</option>";
                }
                echo "</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td> Exam Name</td>
            <td><input type="text" name="exam_name" class="form-control" style="width: 400px"/></td>
        </tr>
        <tr>
            <td> Exam Date</td>
            <td ><input type="date" name="exam_date" class="form-control"/></td>
        </tr>
        <tr>
            <td> Description</td>
            <td ><input type="text" name="exam_description" class="form-control"/></td>
        </tr>
        <tr>
            <td> </td>
            <td>
                <input type="submit"  value="create" class="btn btn-primary fa-pull-right"/>
            </td>
        </tr>
    </table>
</form>
