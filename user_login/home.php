<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/19/2018
 * Time: 5:53 AM
 */
session_start();
// if user not login redirect tologin page
if(!isset($_SESSION['loggedin'])){
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en"/>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Home</title>

    <link rel="stylesheet" type="text/css" href="../common/css/main.css">
    <link rel="stylesheet" type="text/css" href="../common/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../common/css/all.min.css"/>
<body class="loggedin">
    <nav class="navtop">
       <div>
           <h1>Welcome :  <?= $_SESSION['user_name']?></h1>
           <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
           <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
       </div>
    </nav>
    <div class="content">

        <div class="row" style=" margin-right: 50px; margin-left: 50px; padding-top: 30px; text-align: center; height: 300px">
            <div class="col-md-3" style="background-color: #bee5eb;margin-right: 50px; margin-left: 80px ">
                <a href="../staff/view_staff.php" >
                    <img src="../common/img/staff.png" height="120" width="120" style="margin-top: 20px"/>
                </a> <br/><h3>Staff</h3>
                <p class=""> Create, View, Edit and delete staff members</p>
            </div>
            <div class="col-md-3" style="background-color: #bee5eb;margin-right: 50px">
                <a href="../staff/view_staff.php">
                    <img src="../common/img/student.png" height="120" width="120" style="margin-top: 20px" /></a>
                    <br/><h3>Student</h3>
                <p class=""> Create, View, Edit and delete students</p>
            </div>
            <div class="col-md-3" style="background-color: #bee5eb;margin-right: 50px ">
                <a href="../course/course_list.php">
                    <img src="../common/img/course.png" height="120" width="120" style="margin-top: 20px" /></a>
                <br/><h3>Courses</h3>
                <p class=""> Create, View, Edit and delete courses</p>
            </div>
        </div>
    </div>
</body>
</html>