<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/17/2018
 * Time: 8:35 AM
 */
//pagination variable
// page given url parameter, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set records or rows of data per page
$records_per_page =5;
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page*$page) - $records_per_page;
?>