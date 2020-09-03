<?php
// core configuration
include_once "../config/core.php";

// check if logged in as admin
include_once "../admin/login_checker.php";

// include classes
include_once '../config/connection.php';
include_once '../objects/users.php';

// get database connection
$database = new Connection();
$db = $database->getConnection();

// initialize objects
$user = new Users($db);

// set page title
$page_title = "Users";

// include page header HTML
include_once "../admin/header.php";

echo "<div class='col-md-12'>";

// read all users from the database
$stmt = $user->readAll($from_record_num, $records_per_page);

// count retrieved users
$num = $stmt->rowCount();

// to identify page for paging
$page_url="read_users.php?";

// include products table HTML template
include_once "read_users_template.php";

echo "</div>";

// include page footer HTML
include_once "../admin/footer.php";
?>
