<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/16/2018
 * Time: 10:34 PM
 */

    //retrieve records here
    include_once '../config/core.php';
    //include database and objects files
    include_once '../config/connection.php';
    include_once '../objects/staffs.php';

    // get database & objects
    $connection = new Connection();
    $db = $connection->getConnection();

    $staff = new staffs($db);

    $page_title = "";
    include_once "../header.php";

    $stmt= $staff->readAll($from_record_num, $records_per_page);
    // specify the page where paging is used
    $page_url = "staffs/view_staff.php?";
    $total_rows =$staff->countAll();

    //  it controls how the staffs list will be rendered
    include_once "read_template.php";

    include_once "../footer.php";
?>