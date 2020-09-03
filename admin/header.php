<!DOCTYPE html>
<html lang="en"/>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <base href="http://localhost/school-management-system/" />
    <!-- set the page title, for seo purposes too -->
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "school management"; ?></title>

    <link rel="stylesheet" type="text/css" href="common/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="common/css/main.css">
    <link href="<?php echo $home_url . "libs/css/admin.css" ?>" rel="stylesheet" />
</head>
<body >
    <?php
    // include top navigation bar
    include_once "navigation.php";
    ?>

    <!-- container -->
    <div class="container">

        <!-- display page title -->
        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo isset($page_title) ? $page_title : "Admin Page"; ?></h1>
            </div>
        </div>
