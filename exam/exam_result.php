<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 8/29/2018
 * Time: 11:13 PM
 */

    require_once '../config/connection.php';
    require_once '../objects/exam.php';
    require_once '../objects/exam_result.php';

    $conn = new Connection();
    $db = $conn->getConnection();

    //pass connection to database
    $exam = new exam($db);
    $exam_result = new exam_result($db);

    $page_title="Exam Result";

    require_once '../header.php';
    ?>
<?php
    if($_POST){

        $exam_result->exam_id = $_POST['exam_id'];
        $exam_result->exam_value = $_POST['exam_value'];

        if($exam_result->createExamResult()){
            echo "<div class='alert alert-success'> successfully created</div>";
        }
        else{
            echo "<div class='alert alert-danger'> filed to create </div>";
        }
    }
    ?>
    <a href="course/teacher_section.php" class="fa-pull-right btn btn-primary"><span class="fas fa-plus" ></span>Assign Teacher</a>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" METHOD="post">

        <table class="table table-hover table-responsive" style="padding-left: 400px">
            <tr>
                <td> Exam </td>
                <td>
                    <?php
                    $stmt = $exam->readExam();
                    echo "<select class='form-control' name='exam_id'>";
                    echo "<option >Select Exam...</option>";
                    while($row_exam =$stmt->Fetch(PDO::FETCH_ASSOC)){
                        extract($row_exam);
                        echo "<option value='{$exam_id}'>{$exam_name}</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>
            <tr>
                <td> Result</td>
                <td><input type="text" name="exam_value" class="form-control" style="width: 400px"/></td>
            </tr>
            <tr>
                <td> </td>
                <td>
                    <input type="submit"  value="create" class="btn btn-primary fa-pull-right"/>
                </td>
            </tr>
        </table>
    </form>
