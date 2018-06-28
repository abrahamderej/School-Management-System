<?php
// search form
echo " <div class='row'>
 <div class='col-md-6'></div>
 <div class='col-md-4'>";
echo "<form role='search' action='staff/search_staff.php'>
        <div class='input-group  fa-pull-left '>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type last name or first name...' name='s' id='srch-term' required {$search_value} /> 
            <div class='input-group-btn'>
            <button class='btn btn-primary fa-search'  type='submit'></button>
            </div>
        </div>
    </form>
 </div>";
 echo "<div class='col-md-2'> 
        <div class='right-button-margin'>
        <a href='staff/create_staff.php' class='btn btn-primary fa-pull-left'>
        <span class='glyphicon glyphicon-plus'></span> Register Staff </a></div>
        </div>
</div>";


// check if more than 0 records found
    if($total_rows >0) {
        echo "<table class='table table-hover table-responsive' style='padding-left: 150px;'>";
        echo "<tr>";
        echo "<th> Last Name </th>";
        echo "<th> First Name </th>";
        echo "<th> Middle Name </th>";
        echo "<th> Gender </th>";
        echo "<th> Job Title </th>";
        echo "<th> Email </th>";
        echo "<th> Mobile </th>";
        echo "<th> Telephone </th>";
        echo "<th> Action </th>";
        echo "</tr>";

        // retrieve our table contents fetch() is faster the fetchAll()
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

//            // extract row this will make $row['first_name'] to just first_name only
            extract($row);

            echo "<tr>";
            echo "<td> {$last_name} </td>";
            echo "<td> {$first_name} </td>";
            echo "<td> {$middle_name} </td>";
            echo "<td> {$gender} </td>";
            echo "<td> {$job_title} </td>";
            echo "<td> {$email} </td>";
            echo "<td> {$mobile} </td>";
            echo "<td> {$telephone} </td>";
            echo "<td>";
            echo "<a href='staff/detail_staff.php?staff_id={$staff_id}' class='btn btn-primary left-margin'><span class='glyphicon glyphicon-list'></span> Read</a>";
            echo "<a href='staff/update_staff.php?staff_id={$staff_id}' class='btn btn-info left-margin'> <span class='glyphicon glyphicon-edit'></span> Edit</a>";
            echo "<a delete-staff_id='{$staff_id}'  class='btn btn-danger delete-object'> <span class='glyphicon glyphicon-remove'></span> Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        include_once "../config/paging.php";
    }
    else{
        echo "<div class='alert-danger'> no records found.</div>";
    }
?>
