<?php
include_once "../config/core.php";
//include database and objects files
require_once '../config/connection.php';
require_once '../objects/students.php';
require_once '../objects/users.php';

$page_title = "Register";

// get database connection
$connection = new Connection();
$db = $connection->getConnection();

// pass connection to objects
$student = new students($db);
$user = new users($db);

// set id of staffs to be edited
$user->user_id= $user->userID();
// read the details of staffs
$user->readOne();

$page_title = "Register Student";
require_once "../admin/header.php";

// content will be here
echo "<div class='right-button-margin'>
<a href='student/view_student.php' class='btn btn-primary fa-pull-right'> List of Students</a>
</div>";
?>
<?php

//echo $_SESSION['staff_id'];

if($_POST){

    // set staffs property values
    $student->student_id = $_POST['student_id'];
    $student->user_id = $user->user_id;
    $student->gender = $_POST['gender'];
    $student->birth_date = $_POST['birth_date'];
    $student->mobile = $_POST['mobile'];
    $student->date_of_join = $_POST['date_of_join'];
    $profile_image = !empty($_FILES["profile_image"]["name"])
        ? sha1_file($_FILES['profile_image']['tmp_name']) . "-" .
        basename($_FILES["profile_image"]["name"]): "";
    $student ->profile_image = $profile_image;

    // create the staffs
    if($student -> create()){
        echo "<div class='alert alert-success'> Staff Successful created</div>";
        echo $student->uploadPhoto();
    }
    else{
        echo "<div class='alert alert-danger'> Unable to create Staff </div>";
    }

}
?>

    <div class="row">
        <div class="col-md-4">
            <?php
            echo $user->first_name . "</br>";
            echo $user->middle_name . "</br>";
            echo $user->last_name . "</br>";
            echo $user->user_name . "</br>";
            echo $user->email . "</br>";
            echo $user->address . "</br>";
            ?>
        </div>
        <div class="col-md-8">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" METHOD="post" enctype="multipart/form-data">

                <table class="table table-hover table-responsive">
                    <tr>
                        <tr>
                            <td> Student ID</td>
                            <td><input type="text" name="student_id" class="form-control" required <?php echo isset($_POST['student_id']) ? htmlspecialchars($_POST['student_id'], ENT_QUOTES) : "";  ?>/></td>
                        </tr>
                        <td> Gender</td>
                        <td>
                            <select class="form-control" name="gender">
                                <option >Select gender</option>
                                <option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> Birth Date</td>
                        <td><input type="date" name="birth_date" class="form-control" required <?php echo isset($_POST['birth_date']) ? htmlspecialchars($_POST['birth_date'], ENT_QUOTES) : "";  ?>/></td>
                    </tr>
                    <tr>
                        <td> Mobile</td>
                        <td><input type="text" name="mobile" class="form-control" required <?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile'], ENT_QUOTES) : "";  ?>/></td>
                    </tr>
                    <tr>
                        <td> Date Of Join</td>
                        <td><input type="date" name="date_of_join" class="form-control" <?php echo isset($_POST['date_of_join']) ? htmlspecialchars($_POST['date_of_join'], ENT_QUOTES) : "";  ?>/></td>
                    </tr>
                    <tr>
                        <td> Profile Photo</td>
                        <td><input type="file" name="profile_image" class="form-control"/></td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td>
                            <input type="submit"  value="Register" class="btn btn-primary fa-pull-right"/>
                        </td>
                    </tr>

                </table>

            </form>
        </div>
    </div>

<?php
//footer
require_once "../footer.php";
?>