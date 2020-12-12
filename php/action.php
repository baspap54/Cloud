<?php  
//action.php
// Include config file
require_once "config.php";

// Initialize the session

$input = filter_input_array(INPUT_POST);

$title = mysqli_real_escape_string($conn, $input["title"]);
$category = mysqli_real_escape_string($conn, $input["category"]);
$startDate = mysqli_real_escape_string($conn, $input["startDate"]);
$endDate = mysqli_real_escape_string($conn, $input["endDate"]);


if($input["action"] === 'edit')
{

 $query = "
 UPDATE movies
 SET title = '".$title."', 
 category = '".$category."', 
 startDate = '".$startDate."', 
 endDate = '".$endDate."'

 WHERE movie_id = '".$input["movie_id"]."'
 ";

 mysqli_query($conn, $query);

}

echo json_encode($input);


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>


