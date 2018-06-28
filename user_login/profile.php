<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/19/2018
 * Time: 6:14 AM
 */
    session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: index.html');
        exit;

}
    require_once '../config/connection.php';
    // get database connection

    $connection = new Connection();
    $db = $connection->getConnection();

    $query = "select password, email from user_login where user_login_id =?";
    $stmt = $db->prepare($query);
    $stmt-> bindParam(1, $_SESSION['user_login_id']);
    $stmt->execute();
    $row= $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    ?>


<!DOCTYPE html>
<html lang="en"/>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>Profile Page</title>

    <link rel="stylesheet" type="text/css" href="../common/css/main.css">
    <link rel="stylesheet" type="text/css" href="../common/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../common/css/all.min.css"/>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1>Website</h1>
        <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>
<div class="content">
    <h2>Profile Page</h2>
    <p> Your Account Detail are below</p>
    <table>
        <tr>
            <td>User Name:</td>
            <td> <?= $_SESSION['user_name']?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td> <?= $email ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td> <?= $password ?></td>
        </tr>
    </table>
</div>
</body>
</html>
