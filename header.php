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
<!-- include the navigation bar -->
<?php include_once 'navigation.php'; ?>

<!-- container -->
<div class="container margin-top-40">

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
