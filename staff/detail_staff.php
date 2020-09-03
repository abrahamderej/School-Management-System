<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/17/2018
 * Time: 7:19 AM
 */
$staff_id = isset($_GET['staff_id']) ? $_GET['staff_id']: die('Error : missing ID');
//include database and objects files
include_once '../config/connection.php';
include_once '../objects/staffs.php';

// get database connection
$connection = new Connection();
$db = $connection->getConnection();

// pass connection to objects and prepare object
$staff = new staffs($db);
// set id of staffs to be edited
$staff->staff_id= $staff_id;
// read the details of staffs
$staff->readOne();
$page_title = "Detail about users";
include_once "../header.php";

    echo "<div class='right-button-margin'>
           <a href='staffs/view_staff.php' class='btn btn-primary fa-pull-right'> <span class='fa fa-list'></span> Read Staff</a>
           </div>";
    ?>

     <table class="table table-hover table-responsive" style="padding-left: 250px;">
        <tr>
            <td> Last Name</td>
            <td><?php echo $staff->last_name ?></td>
        </tr>
        <tr>
            <td> First Name</td>
            <td><?php echo $staff->first_name ?></td>
        </tr>
        <tr>
            <td> Middle Name</td>
            <td><?php echo $staff->middle_name ?></td>
        </tr>
        <tr>
            <td> Email</td>
            <td><?php echo $staff->email ?></td>
        </tr><tr>
            <td> Profile</td>
            <td><?php echo $staff->profile_image ? "<img src='uploads/{$staff->profile_image}' style='width: 100px;'/>": "NO Image Found. ";?></td>
        </tr>
    </table>

<?php
include_once "../footer.php";

?>