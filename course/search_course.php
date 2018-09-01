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
include_once '../objects/course.php';
include_once '../objects/grade.php';

// get database & objects
$connection = new Connection();
$db = $connection->getConnection();

$course = new course($db);
$grade = new grade($db);

$search_term = isset($_GET['s']) ? $_GET['s'] : 'insert search term';
$page_title = " You searched for \"{$search_term}\"";
include_once "../header.php";

//query staff
$stmt=$course->search($search_term, $from_record_num ,$records_per_page);

// specify the page where paging is used
$page_url = "search_course.php?s={$search_term}&";
$total_rows =$course->countAll_BySearch($search_term);

//  it controls how the staff list will be rendered
include_once "read_template.php";
include_once "../footer.php";
?>/