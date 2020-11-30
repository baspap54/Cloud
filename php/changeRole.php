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


$user_id = $_GET["id"];
$role_id = $_GET['role_id'];
$sql = "UPDATE user_role SET role_id='".$role_id."' WHERE id=".$user_id;

mysqli_query($conn,$sql);
mysqli_close($conn);
header('Location: administration.php');

?>
