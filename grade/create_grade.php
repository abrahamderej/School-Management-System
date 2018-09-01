<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 8/29/2018
 * Time: 3:22 AM
 */

require_once '../config/connection.php';
require_once '../objects/grade.php';

$conn = new Connection();
$db = $conn->getConnection();

$grade = new grade($db);

$page_title=" Create Grade";

require_once '../header.php';
?>
<?php
if($_POST){
    $grade->grade_name = $_POST['grade_name'];
    $grade->description = $_POST['description'];

    if($grade->createGrade()){
        echo "<div class='alert alert-success'> grade created</div>";
    }
    else{
        echo "<div class='alert alert-danger'> filed to create grade</div>";
    }
}


?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" METHOD="post" enctype="multipart/form-data">

    <table class="table table-hover table-responsive" style="padding-left: 400px">
        <tr>
            <td> Grade</td>
            <td><input type="text" name="grade_name" class="form-control"/></td>
        </tr>
        <tr>
            <td> Description</td>
            <td ><textarea name="description" rows="4" placeholder="put some description" class="form-control" style="width: 400px"> </textarea></td>
        </tr>
        <tr>
            <td> </td>
            <td>
                <input type="submit"  value="create" class="btn btn-primary fa-pull-right"/>
            </td>
        </tr>
    </table>
</form>
