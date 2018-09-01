<?php
// search form
echo " <div class='row'>
 <div class='col-md-6'></div>
 <div class='col-md-4'>";
echo "<form role='search' action='course/search_course.php'>
        <div class='input-group  fa-pull-left '>";
$search_value=isset($search_term) ? "value='{$search_term}'" : "";
echo "<input type='text' class='form-control' placeholder='Type last name or first name...' name='s' id='srch-term' required {$search_value} /> 
            <div class='input-group-btn' >
            <button class='btn btn-primary' type='submit'> <i class='fa fa-search-plus'></i> </button>
            </div>
        </div>
    </form>
 </div>";
echo "<div class='col-md-2'> 
        <div class='right-button-margin'>
        <a href='course/create_course.php' class='btn btn-primary fa-pull-left'>
        <span class='fa fa-plus'></span> ADD</a></div>
        </div>
</div>";


// check if more than 0 records found
if($total_rows >0) {

    echo "<table class='table table-hover table-responsive' style='padding-left: 250px;'>";
    echo "<tr>";
    echo "<th> Course Name </th>";
    echo "<th> Credit Hour </th>";
    echo "<th> Grade </th>";
    echo "<th> Action </th>";
    echo "</tr>";

    // retrieve our table contents fetch() is faster the fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
        echo "<td> {$course_name} </td>";
        echo "<td> {$credit_hour} </td>";
        echo "<td>";
            $grade->grade_id = $grade_id;
            $grade->readGradeName();
            echo $grade->grade_name;
        echo "</td>";
        echo "<td>";
        echo "<a href='course/course_detail.php?course_id={$course_id}' class='btn btn-primary left-margin'><span class='fas fa-list'></span> Read</a>";
        echo "<a href='course/update_course.php?course_id={$course_id}' class='btn btn-info left-margin'> <span class='fas fa-edit'></span> Edit</a>";
        echo "<a delete-id=''  class='btn btn-danger delete-object'> <span class='fa fa-trash-alt'></span> Delete</a>";
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