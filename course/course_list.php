<?php

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

$page_title = "";
include_once "../header.php";

$stmt= $course->readAll($from_record_num, $records_per_page);
// specify the page where paging is used
$page_url = "course/course_list.php?";
$total_rows =$course->countAll();

//  it controls how the staff list will be rendered
include_once "read_template.php";

include_once "../footer.php";
?>