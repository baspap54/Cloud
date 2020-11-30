<?php
// Include config file
require_once "config.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$titleId= $_POST['titleId'];
$categoryId= $_POST['categoryId'];
$startId= $_POST['startId'];
$endId= $_POST['endId'];
$cinema =  $_SESSION["userName"];
$emptyField = false;

echo $titleId;
if(empty($titleId)||empty($categoryId)||empty($startId)||empty($endId)){
$emptyField=true;
}

//debug_to_console("Test");

$sql = "INSERT INTO movies (title, category, startDate, endDate, cinemaName) VALUES (?, ?, ?, ?, ?)";
if($stmt = mysqli_prepare($conn, $sql)){
    
    mysqli_stmt_bind_param($stmt, "sssss", $param_title, $param_category, $param_startDate, $param_endDate, $param_cinemaName);

    $param_title = $titleId;
    $param_category = $categoryId;
    $param_startDate = $startId;
    $param_endDate = $endId;
    $param_cinemaName = $cinema;

    if(mysqli_stmt_execute($stmt)){
        echo json_encode(array('success'=>TRUE,'message'=>"Added"));
        mysqli_close($conn);
   
        exit;
    }

}



?>
