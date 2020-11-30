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
$sql = "DELETE FROM favorites WHERE movie_id = $movie_id AND id = $user_id"; 
?>
<script type="text/javascript">
var id = <?php echo $movie_id ?>;
alert(id)
</script>
<?php

if($stmt = mysqli_prepare($conn, $sql)){
    
    if($stmt = mysqli_prepare($conn, $sql)){
        if(mysqli_stmt_execute($stmt)){
        	echo json_encode(array('success'=>TRUE,'message'=>"Removed"));
            mysqli_close($conn);
            
            //header('Location: showFavorites.php');
            exit;
        }
    }
}

?>
