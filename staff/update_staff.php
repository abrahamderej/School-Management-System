<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/17/2018
 * Time: 3:52 AM
 */

    $staff_id = isset($_GET['staff_id']) ? $_GET['staff_id']: die('Error : missing ID');
    //include database and objects files
    include_once '../config/connection.php';
    include_once '../objects/staff.php';

    // get database connection
    $connection = new Connection();
    $db = $connection->getConnection();

    // pass connection to objects and prepare object
    $staff = new Staff($db);
    // set id of staff to be edited
    $staff->staff_id= $staff_id;

    // read the details of staff
    $staff->readOne();
    $page_title = "Update Staff";
    include_once "../header.php";

    echo "<div class='right-button-margin'>
        <a href='staff/view_staff.php' class='btn btn-primary' style='text-align: center'> Read Staff</a>
        </div>";

    ?>
    <?php
    if($_POST){

        // set staff property values
        $staff ->last_name = $_POST['last_name'];
        $staff ->first_name = $_POST['first_name'];
        $staff ->middle_name = $_POST['middle_name'];
        $staff ->gender = $_POST['gender'];
        $staff ->job_title = $_POST['job_title'];
        $staff-> email = $_POST['email'];
        $staff ->mobile = $_POST['mobile'];
        $staff ->telephone = $_POST['telephone'];
        $profile_image = !empty($_FILES["profile_image"]["name"])
            ? sha1_file($_FILES['profile_image']['tmp_name']) . "-" .
            basename($_FILES["profile_image"]["name"]): "";
        $staff ->profile_image = $profile_image ;

        // update the staff
        if($staff -> update()){
            echo "<div class='alert alert-success alert-dismissible'> Staff Successful updated</div>";
            echo $staff->uploadPhoto();
        }
        else{
            echo "<div class='alert alert-danger alert-dismissible'> Unable to update Staff </div>";
        }

    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?staff_id={$staff_id}");?>" METHOD="post" enctype="multipart/form-data">

        <table class="table table-hover table-responsive" style="width: 1000px; padding-left: 400px">
            <tr>
                <td> Last Name</td>
                <td><input type="text" name="last_name" value="<?php echo $staff->last_name; ?>" class="form-control"/></td>
            </tr>
            <tr>
                <td> First Name</td>
                <td><input type="text" name="first_name" value="<?php echo $staff->first_name; ?>" class="form-control"/></td>
            </tr>
            <tr>
                <td> Middle Name</td>
                <td><input type="text" name="middle_name" value="<?php echo $staff->middle_name; ?>" class="form-control"/></td>
            </tr>
            <tr>
                <td> Gender</td>
                <td>
                    <select class="form-control" name="gender">
                        <option >Select gender</option>
                        <option <?php if(htmlspecialchars($staff->gender, ENT_QUOTES) == 'MALE') {echo "selected";}?>>MALE</option>
                        <option <?php if(htmlspecialchars($staff->gender, ENT_QUOTES) == 'FEMALE') {echo "selected";}?>>FEMALE</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td> Profile Photo</td>
                <td><input type="file" name="profile_image" value="<?php echo $staff->profile_image; ?> "class="form-control"/></td>
            </tr>
            <tr>
                <td> Job Title</td>
                <td><input type="text" name="job_title" value="<?php echo $staff->job_title; ?>" class="form-control"/></td>
            </tr>
            <tr>
                <td> Email</td>
                <td><input type="email" name="email" value="<?php echo $staff->email; ?>" class="form-control"/></td>
            </tr>
            <tr>
                <td> Mobile</td>
                <td><input type="text" name="mobile" value="<?php echo $staff->mobile; ?>" class="form-control"/></td>
            </tr>
            <tr>
                <td> Telephone Number</td>
                <td><input type="text" name="telephone" value="<?php echo $staff->telephone; ?>" class="form-control"/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit"  value="Update" class="btn btn-primary"/>
                </td>
            </tr>

        </table>

    </form>
<?
include_once "../footer.php";
?>