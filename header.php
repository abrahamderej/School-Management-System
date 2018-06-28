<!DOCTYPE html>
<html lang="en"/>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <base href="http://localhost/SchoolMngtOOP/" />
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
        <a href="staff/view_staff.php">Add Course</a>
    </div>
    <?php
    echo "<div class='page-header' style='text-align: center; margin-top: 80px'>
        <h2 >{$page_title}</h2>
           </div>"
    ;?>


<script>
    function disableNav() {
        if(document.getElementById("logout")){
            disable(document.getElementById("nav"));
        }
    }
</script>