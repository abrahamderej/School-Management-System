<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/17/2018
 * Time: 7:50 AM
 */

if($_POST){
    //include database and objects files
    require_once '../config/connection.php';
    require_once '../objects/staff.php';

    // get database & objects
    $connection = new Connection();
    $db = $connection->getConnection();

    $staff = new staff($db);
    $staff->staff_id = $_POST['object_id'];

    if($staff->delete()){
        echo "Object was deleted.";
    }
    else{
        echo "Unable to delete Object.";
    }
}