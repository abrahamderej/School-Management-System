<?php
// display the table if the number of users retrieved was greater than zero
if($num>0){

    echo "<table class='table table-hover table-responsive table-bordered'>";

    // table headers
    echo "<tr>";
    echo "<th>First Name</th>";
    echo "<th>Middle name</th>";
    echo "<th>Last name</th>";
    echo "<th>User name</th>";
    echo "<th>Email</th>";
    echo "<th>Address</th>";
    echo "<th>Access Level</th>";
    echo "<th>Access Code</th>";
    echo "</tr>";

    // loop through the user records
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        // display user details
        echo "<tr>";
        echo "<td>{$first_name}</td>";
        echo "<td>{$middle_name}</td>";
        echo "<td>{$last_name}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$email}</td>";
        echo "<td>{$address}</td>";
        echo "<td>{$access_level}</td>";
        echo "<td>{$access_code}</td>";
        echo "</tr>";
    }

    echo "</table>";

    $page_url="user_list.php?";
    $total_rows = $user->countAll();

    // actual paging buttons
    include_once '../config/paging.php';
}

// tell the user there are no selfies
else{
    echo "<div class='alert alert-danger'>
		<strong>No users found.</strong>
	</div>";
}
?>
