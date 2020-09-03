<!DOCTYPE html>
<html lang="en"/>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--<base href="http://localhost/school-management-system/" />
    -- set the page title, for seo purposes too -->
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "school management"; ?></title>

    <link rel="stylesheet" type="text/css" href="common/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="common/css/main.css">
    <link rel="stylesheet" type="text/css" href="common/css/all.min.css"/>
</head>
<body>
<!-- container-->
<!--<div class="container-fluid" >-->
<!--    <nav class="navtop navbar navbar-expand-lg fixed-top" id="nav">-->
<!--        <div>-->
<!--            <h1><a href="user/home.php" style="font-size: 20px">Website</a></h1>-->
<!--            <a href="user/profile.php"><i class="fas fa-user-plus"></i>Profile</a>-->
<!--            <a href="user/logout.php" id="logout" onclick="disableNav()"><i class="fas fa-sign-out-alt"></i>Logout</a>-->
<!--        </div>-->
<!---->
<!--    </nav>-->
<!--</div>-->
<!--<div class="sidenav">-->
<!--        <a href="staff/view_staff.php">Staff</a>-->
<!--        <a href="staff/view_staff.php">Student</a>-->
<!--        <a href="course/course_list.php">Course</a>-->
<!--        <img src="common/img/place_holder.jpg" height="130" width="130" style='margin-left: 15px;margin-top: 20px;' />-->
<!--        <h3 style="text-align: center; color: lightcyan">welcome</h3>-->
<!--    </div>-->

<!-- include the navigation bar -->
<?php include_once 'navigation.php'; ?>

<!-- container -->
<div class="container">

    <?php
    // if given page title is 'Login', do not display the title
    if($page_title!="Login"){
        ?>
        <div class='col-md-12'>
            <div class="page-header">
                <h1><?php echo isset($page_title) ? $page_title : "School Management School"; ?></h1>
            </div>
        </div>
        <?php
    }
    ?>
