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


$user_id = $_SESSION["id"];
$movie_id = $_GET['id'];
$sql = "INSERT INTO favorites(id, movie_id) VALUES (?, ?)"; 

if($stmt = mysqli_prepare($conn, $sql)){
    
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $movie_id);
    $param_username = $user_id;
    $param_username = $movie_id;
    if(mysqli_stmt_execute($stmt)){
        echo json_encode(array('success'=>TRUE,'message'=>"Added"));
        mysqli_close($conn);
        //header('Location: movies.php');
        exit;
    }
    else{
        $sql = "DELETE FROM favorites WHERE movie_id = $movie_id AND id = $user_id"; 
        if($stmt = mysqli_prepare($conn, $sql)){
            if(mysqli_stmt_execute($stmt)){
                echo json_encode(array('success'=>TRUE,'message'=>"Removed"));
                mysqli_close($conn);
               // header('Location: movies.php');
                exit;
            }
        exit;
    }
}
}

?>
