<?php
//include database and objects files
require_once '../config/connection.php';
require_once '../objects/staffs.php';

// get database connection
$connection = new Connection();
$db = $connection->getConnection();

// pass connection to objects
$staff = new staffs($db);

$page_title = "Register Staff Member";
require_once "../header.php";

// content will be here
echo "<div class='right-button-margin'>
<a href='staffs/view_staff.php' class='btn btn-primary fa-pull-right'> Read Staff</a>
</div>";
?>
<?php
if($_POST){

    // set staffs property values
    $staff ->user_id = $_POST['user_id'];
    $staff ->gender = $_POST['gender'];
    $staff ->job_title = $_POST['job_title'];
    $staff ->mobile = $_POST['mobile'];
    $staff ->telephone = $_POST['telephone'];
    $profile_image = !empty($_FILES["profile_image"]["name"])
        ? sha1_file($_FILES['profile_image']['tmp_name']) . "-" .
        basename($_FILES["profile_image"]["name"]): "";
    $staff ->profile_image = $profile_image;

    // create the staffs
    if($staff -> create()){
        echo "<div class='alert alert-success'> Staff Successful created</div>";
        echo $staff->uploadPhoto();
    }
    else{
        echo "<div class='alert alert-danger'> Unable to create Staff </div>";
    }

}
?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" METHOD="post" enctype="multipart/form-data">

        <table class="table table-hover table-responsive" style="padding-left: 250px">
            <tr>
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
                <td> Profile Photo</td>
                <td><input type="file" name="profile_image" class="form-control"/></td>
            </tr>
            <tr>
                <td> Job Title</td>
                <td><input type="text" name="job_title" class="form-control"/></td>
            </tr>
            <tr>
                <td> Mobile</td>
                <td><input type="text" name="mobile" class="form-control"/></td>
            </tr>
            <tr>
                <td> Telephone Number</td>
                <td><input type="text" name="telephone" class="form-control"/></td>
            </tr>
            <tr>
                <td> </td>
                <td>
                    <input type="submit"  value="Register" class="btn btn-primary fa-pull-right"/>
                </td>
            </tr>

        </table>

    </form>
<?php
//footer
require_once "../footer.php";
?>