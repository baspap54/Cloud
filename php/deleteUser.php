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

//first we need to delete the user from other tables that reference the users table 
$sql = "DELETE FROM favorites WHERE id = $user_id"; 
if($stmt = mysqli_prepare($conn, $sql)){

      if(mysqli_stmt_execute($stmt)){

        $sql = "DELETE FROM user_role WHERE id = $user_id";
        if ($stmt = mysqli_prepare($conn, $sql)){
            if(mysqli_stmt_execute($stmt)){

            $sql = "DELETE FROM users WHERE id = $user_id";
            if($stmt = mysqli_prepare($conn, $sql)){
                if(mysqli_stmt_execute($stmt)){
                    mysqli_close($conn);
                    header('Location: administration.php');
                    exit;
                }

            }
        }
    }
}
    
}

?>
