<!-- <!DOCTYPE html>
<html lang="en"/>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <base href="http://localhost/school-management-system/" />
    <title>index</title>

    <link rel="stylesheet" type="text/css" href="common/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="common/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="common/css/main.css">
<body >
 container
<div class="container-fluid" >
    <nav class="navtop navbar navbar-expand-lg fixed-top" id="nav">
       <div>-->
<!--            <h1><a href="user_login/home.php" style="font-size: 20px">Website</a></h1>-->
<!--            <a href="user_login/profile.php"><i class="fas fa-user-circle"></i>Profile</a>-->
<!--            <a href="user_login/logout.php" id="logout"><i class="fas fa-sign-out-alt"></i>Logout</a>-->
<!--        </div>

    </nav>

/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/19/2018
 * Time: 2:11 AM
 */
//$page_title="";
//    require_once "header.php";
    echo "<div class='login'>
        <h1>Login</h1>
        <form action='user/authenticateUser.php' method='post'>
            <label for='user_name'><i class='fas fa-user'></i></label>
            <input type='text' name='user_name' placeholder='User Name' id='user_name' required>
            <label for='password'><i class='fas fa-lock'></i></label>
            <input type='password' name='password' placeholder='Password' id='password' required>
            <a href='' class='active'> forget password</a>
            <input type='submit' value='Login'>
        </form>
    </div>";
    require_once "footer.php";

?>-->



    <?php
    // core configuration
    include_once "config/core.php";

    // set page title
    $page_title="Index";

    // include login checker
    $require_login=true;
    include_once "login_checker.php";

    // include page header HTML
    include_once 'header.php';

    echo "<div class='col-md-12'>";

    // to prevent undefined index notice
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    // if login was successful
    if($action=='login_success'){
        echo "<div class='alert alert-info'>";
        echo "<strong>Hi " . $_SESSION['first_name'] . ", welcome back!</strong>";
        echo "</div>";
    }

    // if user is already logged in, shown when user tries to access the login page
    else if($action=='already_logged_in'){
        echo "<div class='alert alert-info'>";
        echo "<strong>You are already logged in.</strong>";
        echo "</div>";
    }

    // content once logged in
    echo "<div class='alert alert-info'>";
    echo "Content when logged in will be here. For example, your premium products or services.";
    echo "</div>";

    echo "</div>";

    // footer HTML and JavaScript codes
    include 'footer.php';
    ?>

