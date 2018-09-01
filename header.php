<!DOCTYPE html>
<html lang="en"/>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <base href="http://localhost/school-management-system/" />
    <title><?php echo $page_title; ?></title>

    <link rel="stylesheet" type="text/css" href="common/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="common/css/main.css">
    <link rel="stylesheet" type="text/css" href="common/css/all.min.css"/>
<body >
<!-- container-->
<div class="container-fluid" >
    <nav class="navtop navbar navbar-expand-lg fixed-top" id="nav">
        <div>
            <h1><a href="user_login/home.php" style="font-size: 20px">Website</a></h1>
            <a href="user_login/profile.php"><i class="fas fa-user-plus"></i>Profile</a>
            <a href="user_login/logout.php" id="logout" onclick="disableNav()"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>

    </nav>
    <div class="sidenav">
        <a href="staff/view_staff.php">Staff</a>
        <a href="staff/view_staff.php">Student</a>
        <a href="course/course_list.php">Course</a>
        <img src="common/img/place_holder.jpg" height="130" width="130" style='margin-left: 15px;margin-top: 20px;' />
        <h3 style="text-align: center; color: lightcyan">welcome</h3>
    </div>
    <?php
    echo "<div class='page-header' style='text-align: center; margin-top: 80px'>
        <h5 >{$page_title}</h5>
           </div>"
    ;?>


<script>
    function disableNav() {
        if(document.getElementById("logout")){
            disable(document.getElementById("nav"));
        }
    }
</script>