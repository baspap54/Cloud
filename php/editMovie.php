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
$rName = $_SESSION["roleName"];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PLACEHOLDER</title>
        <link rel="stylesheet" type="text/css">
        <style>
            
        body{
            margin: 0;
            padding: 0;
            background: url(background.jpg);
            background-size: cover;
            background-position:top;
            font-family:serif;
        }
            
        .formm{
            position: fixed;
            width:  16%;
            height: 10%;
            background-color: hsla(556, 50%, 25%, 0.3);   
            
        }
        h0{
            position: relative;
            top:15%;
            transform: translate(-50%,-50%);
            box-sizing: content-box;
            padding: 10px 20px;
            margin: auto;  
            color: #c20404;
            font-size: 40px;
            font-style: normal;
            text-align: center;
        } 
        .back_button {
            position:fixed;
            top:2%;
            left: 45%;
            background-color: #620000;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 11px 50px;
            text-decoration: none;
            font-family: serif;
            font-size: larger;
        }          
        .back_button:hover{
            cursor: pointer;
            background:  #ff0000;
            color: #000;
        }
        .form2 {
            min-width: 320px;
            min-height: 300px;
            background-color: rgba(131, 0, 0, 0.877);
            top: 50%;
            left: 50%;
            position: absolute;
            transform: translate(-50%,-50%);
            box-sizing: border-box;
            padding: 10px 30px;
        }

        h3{
            text-align: center;
        }    
        .logout_button {
            position:fixed;
            top:2%;
            left: 90%;
            background-color: #620000;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 7px 10px;
            text-decoration: none;
            font-family: sans-serif;
        }        
        .logout_button:hover{
            cursor: pointer;
            background:  #ff0000;
            color: #000;
        }         
                        
        .user_name{
            position: fixed;
            top:5%;
            left:88%;
            color: #fff;      
            font-family:monospace;
        }

        .form3{
            position: absolute;
            top:15%;
            left:30%;
        }
        .add_button {       
            background-color: #620000;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 5px 25px;
            text-decoration: none;
            font-size: 15px;
            font-family: sans-serif;
        }        
        .add_button:hover{
            cursor: pointer;
            background:  #ff0000;
            color: #000;
        }  
        .movies_table{
            border-collapse:collapse;
            margin 25px 0;
            min-width: 320px;
            text-align:center;
            padding: 70px 30px;
            color: #fff;
            font-size: 20px;
            font-style: normal;
            
        }
        .movies_table thead tr{
            color: #fff;
            font-size: 20px;
            text-align:center;
            font-weight:bold;
            color: #fff;
            background-color: rgba(131, 0, 0, 0.877);
        }


        .movies_bable th,
        .movies_table td{
            padding: 7px 15px;
            min-width: 120px;
        }

        .movies_table tbody tr{
            border-bottom: 1px solid #000;
            background-color:#a33131;
            color:#fff;
        } 
        .addtofav_button {       
            background-color: #620000;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 5px 25px;
            text-decoration: none;
            font-size: 15px;
            font-family: sans-serif;
        }        
        .addtofav_button:hover{
            cursor: pointer;
            background:  #ff0000;
            color: #000;
        }
        </style>    
    </head>


    <body>  
       
            <h0>PLACEHOLDER</h0>  
    
        
        <div class="back_button">
            <a style="font-size: 28px;" class="back_button" href="welcome.php">Home</a> 
        </div>

        <div class="logout_button">
            <a class="logout_button" href="logout.php">Log Out</a>
        </div>
        
        <div class="user_name">

        <h1 style="font-size: 17px;font-family: serif;"> &#129409 User: <b><?php echo htmlspecialchars($_SESSION["userName"]); echo("($rName)"); ?></b> </h1>
        </div>
  


        <div class="form2">
                <h3>Edit Movie Info:</h3>
          
                <tr>
                <td>

                <form action="updateMovie.php">
                <input type="hidden" id="movie_id" name="movie_id" value= <?php echo $movie_id; ?> >
                <label for="title"><h4>Title:</h4></label>
                <input type="text" id="title" name="title" value="title" onfocus="if (this.value == 'title') {this.value=''}" onblur="if (this.value == '') {this.value='title'}">
                <label for="category"><h4>Category:</h4></label>
                <input type="text" id="category" name="category" value="category" onfocus="if (this.value == 'category') {this.value=''}" onblur="if (this.value == '') {this.value='category'}">
                <label for="startDate"><h4>Start Date:</h4></label>
                <input type="date" id="startDate" name="startDate" value="startDate" >
                <label for="endDate"><h4>End Date:</h4></label>
                <input type="date" id="endDate" name="endDate" value="endDate" ><br>
                <input type="submit" class=addtofav_button value="Update">
                </form>
                </td>
                </tr>

        </div>


        </body>
</html>  
