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


$user_name = $_SESSION["userName"];
$movie_id = $_GET['id'];
//first we need to delete the movie from favorites because it references movies 
$sql = "DELETE FROM favorites WHERE movie_id = $movie_id"; 
if($stmt = mysqli_prepare($conn, $sql)){

      if(mysqli_stmt_execute($stmt)){

            $sql = "DELETE FROM movies WHERE movie_id = $movie_id";
            if($stmt = mysqli_prepare($conn, $sql)){
                if(mysqli_stmt_execute($stmt)){
                    echo json_encode(array('success'=>TRUE,'message'=>"Removed"));
                    mysqli_close($conn);
                    //header('Location: owner.php');
                    exit;
                }

            }
            
        }
    
}

?>
