<?php
/**
 * Created by PhpStorm.
 * User: jordanpc
 * Date: 6/19/2018
 * Time: 6:33 AM
 */
session_start();
session_destroy();

header('Location: ../index.php');
?>