<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/16/2018
 * Time: 11:17 PM
 */
    echo "<ul class=\"pagination\">";
    // first page button will be here
    if ($page>1){
        echo "<li><a href='{$page_url}' title='Go to the first page'>";
            echo "FIRST Page";
        echo "</a></li>";
    }
    // find out total page
    $total_pages = ceil($total_rows / $records_per_page);

    // range of num links to show
    $range =2;
    // display links to 'range of pages' around 'current page'
    $initial_num = $page - $range;
    $condition_limit_num = ($page + $range) + 1 ;
    for ($x= $initial_num; $x < $condition_limit_num; $x++){
        //be sure '$x is greater than 0' and less than or equal to the $total_pages
        if(($x>0) && ($x <= $total_pages)){

            //current page
            if($x == $page){
                echo "<li class='active' ><a href=\"#\">$x<span class=\"sr-only\">(current)</span></a></li>";
            }
            // not current page
            else{
                echo "<li><a href='{$page_url}page=$x'>$x</a></li>";
            }
        }
    }
    //last page button will be here

    if($page < $total_pages){
        echo "<li><a href='" .$page_url. " page={$total_pages}' title='Last page is {$total_pages}.'>";
            echo "Last Page";
        echo "</a></li>";
    }
    echo "</ul>";
?>
