<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/19/2018
 * Time: 5:09 AM
 */
session_start();
require_once '../config/connection.php';
//require_once '../objects/user_login.php';

// get database connection
$connection = new Connection();
$db = $connection->getConnection();

// pass connection to objects
//$staff = new Staff($db);

//require_once "../common/header.php";

if( !isset($_POST['user_name'], $_POST['password'])){
    exit('Please fill both the User Name and Password correctly');
}

if($stmt = $db->prepare('select user_login_id, password from user_login where user_name= ?')){
    $user_name = htmlspecialchars(strip_tags($_POST['user_name']));
    $stmt-> bindParam(1, $user_name);

    $stmt->execute();
    //store the result so we can check if the account exist in the database
    //$stmt->storeResult();

    if($stmt->rowCount() >0){
        $row = $stmt->fetch();
        extract($row);
        //echo "{$user_login_id}";
        //echo $password;
        // note remember to use password hash $row['password']
        // insert statment-> $pssd = PASSWORD_HASH($_POST["pssd"], PASSWORD_DEFAULT)
        // FOR VERFICATION USE password_verify()

        if($_POST['password']== $password){
            // verify that success user has login id
            // create sessions so we know the user is logged in , the bassically act like cookies but remember the data on the server
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['user_name'] = $_POST['user_name'];
            $_SESSION['user_login_id'] = $user_login_id;
            header('Location: home.php');

        }
        else{
            header('Location: ../index.php');
        }

    }
    else{
        header('Location: ../index.php');
        echo 'incorrect User Name';
    }
}

?>