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

$movie_id = $_GET['movie_id'];
$m_title = $_GET['title'];
$m_category = $_GET['category'];
$m_startDate = $_GET['startDate'];
$m_endDate = $_GET['endDate'];





	if($m_title!="title"){
        $sql="UPDATE movies SET title='$m_title' WHERE movie_id='$movie_id'";
        mysqli_query($conn, $sql);
	}
	if($m_category!="category"){
        $sql="UPDATE movies SET category = '$m_category' WHERE movie_id='$movie_id'";
        mysqli_query($conn, $sql);
	}
	if($m_startDate!=NULL){
        $sql="UPDATE movies SET startDate='$m_startDate' WHERE movie_id='$movie_id'";
        mysqli_query($conn, $sql);
	}
	if($m_endDate!=NULL){
        $sql="UPDATE movies SET endDate='$m_endDate' WHERE movie_id='$movie_id'";
        mysqli_query($conn, $sql);
	}



mysqli_close($conn);
header("Location: owner.php");

?>

