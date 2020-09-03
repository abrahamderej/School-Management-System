<?php
// show error reporting
error_reporting(E_ALL);

// start php session
session_start();

// set your default time-zone
date_default_timezone_set('Asia/Manila');

// home page url
$home_url="http://localhost/school-management-system/";

//pagination variable
// page given url parameter, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set records or rows of data per page
$records_per_page =5;
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page*$page) - $records_per_page;
?>