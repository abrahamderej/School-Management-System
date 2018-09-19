<?php
include_once "../config/core.php";
//include database and objects files
require_once '../config/connection.php';
require_once '../objects/guardian.php';
require_once '../objects/users.php';

$page_title = "Register";

// get database connection
$connection = new Connection();
$db = $connection->getConnection();

// pass connection to objects
$parent = new guardian($db);
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
    $parent->user_id = $user->user_id;
    $parent->parent_type = $_POST['parent_type'];
    $parent->mobile = $_POST['mobile'];
    $parent->telephone = $_POST['telephone'];
    $parent->work_place = $_POST['work_place'];
    // create the staffs
    if($parent -> create()){
        echo "<div class='alert alert-success'> Staff Successful created</div>";
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
                    <td> Parent Type</td>
                    <td>
                        <select class="form-control" name="parent_type">
                            <option >Select gender</option>
                            <option value="Mother">Mother</option>
                            <option value="Father">Father</option>
                            <option value="Legal Guardian">Legal Guardian</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                        <td> Mobile</td>
                        <td><input type="text" name="mobile" class="form-control" required <?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile'], ENT_QUOTES) : "";  ?>/></td>
                    </tr>
                    <tr>
                        <td> Telephone</td>
                        <td><input type="text" name="telephone" class="form-control" required <?php echo isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone'], ENT_QUOTES) : "";  ?>/></td>
                    </tr>
                    <tr>
                        <td> Work Place</td>
                        <td><input type="text" name="work_place" class="form-control" <?php echo isset($_POST['work_place']) ? htmlspecialchars($_POST['work_place'], ENT_QUOTES) : "";  ?>/></td>
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
require_once "../admin/footer.php";
?>