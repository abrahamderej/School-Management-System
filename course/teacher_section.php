<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 8/30/2018
 * Time: 1:04 AM
 */
require_once '../config/connection.php';
require_once '../objects/grade.php';
require_once '../objects/staff.php';
require_once '../objects/class_room.php';

$conn = new Connection();
$db = $conn->getConnection();

//pass connection to database
$grade = new grade($db);
$staff = new staff($db);
$class_room = new class_room($db);

$page_title=" Assign Teacher to Class Room";

require_once '../header.php';
?>
<?php
if($_POST){
    $class_room->teacher_id = $_POST['staff_id'];
    $class_room->grade_id = $_POST['grade_id'];
    $class_room->class_year = $_POST['class_year'];
    $class_room->section = $_POST['section'];
    $class_room->remarks = $_POST['remarks'];

    if($class_room->assignTeacher()){
        echo "<div class='alert alert-success'> course created</div>";
    }
    else{
        echo "<div class='alert alert-danger'> filed to create course</div>";
    }
}


?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" METHOD="post" enctype="multipart/form-data">

    <table class="table table-hover table-responsive" style="padding-left: 400px">
        <tr>
            <td> Teacher</td>
            <td>
                <?php
                $stmt = $staff->read();
                echo "<select class='form-control' name='staff_id'>";
                echo "<option >Select Teacher...</option>";
                while($row_staff =$stmt->Fetch(PDO::FETCH_ASSOC)){
                    extract($row_staff);
                    echo "<option value='{$staff_id}'>{$first_name}</option>";
                }
                echo "</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td> Grade</td>
            <td>
                <?php
                $stmt = $grade->readGrade();
                echo "<select class='form-control' name='grade_id'>";
                echo "<option >Select Grade...</option>";
                while($row_grade =$stmt->Fetch(PDO::FETCH_ASSOC)){
                    extract($row_grade);
                    echo "<option value='{$grade_id}'>{$grade_name}</option>";
                }
                echo "</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td> Year</td>
            <td><input type="date" name="class_year" class="form-control" style="width: 400px"/></td>
        </tr>
        <tr>
            <td> Section</td>
            <td ><input type="text" name="section" class="form-control"/></td>
        </tr>
        <tr>
            <td> Remarks</td>
            <td ><input type="text" name="remarks" class="form-control"/></td>
        </tr>
        <tr>
            <td> </td>
            <td>
                <input type="submit"  value="Assign" class="btn btn-primary fa-pull-right"/>
            </td>
        </tr>
    </table>
</form>
