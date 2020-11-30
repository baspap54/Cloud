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
$u_id = $_SESSION["id"];
$u_name = $_SESSION["userName"];
$sql = "SELECT * FROM movies";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    var_dump(mysqli_error($conn));
    exit;
}
$title = "";
$category = "";
$cinemaName = "";
$startDate = "";
$endDate = "";
   
   
$titleErr = $passwordErr = $categoryErr = $startErr = $endErr = "";
$cinema =  $_SESSION["userName"];

    $titleId = isset($_POST['titleId']) ? $_POST['titleId'] : '';
    $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : '';
    $startId = isset($_POST['startId']) ? $_POST['startId'] : '';
    $endId = isset($_POST['endId']) ? $_POST['endId'] : '';

    $ok = true;
    $messages = array();

    if ( !isset($titleId) || empty($titleId) ) {
        $ok = false;
    }
    else{
        $titleId = trim($_POST["titleId"]);
    }

    if ( !isset($categoryId) || empty($categoryId) ) {
        $ok = false;   
    }
    else{
        $categoryId = trim($_POST["categoryId"]);
    }
    if ( !isset($startId) || empty($startId) ) {
        $ok = false; 
    }
    else{
        $startId = trim($_POST["startId"]);
    
    }
    if ( !isset($endId) || empty($endId) ) {
        $ok = false; 
    }
    else{
        $endId = trim($_POST["endId"]);
    }


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
        label{
            display: none;
        }
        a:link {
            background-color: #620000;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 5px 25px;
            text-decoration: none;
            font-size: 15px;
            font-family: sans-serif;
        }
        a:link, a:visited {
            color: #fff;
        }
        a:hover{
            cursor: pointer;
            background:  #ff0000;
            color: #000;
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
            top: 45%;
            left: 91%;
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
        <script src="addmv.js" type="text/javascript"></script>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript" ></script>
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
        <script src="addmv.js" type="text/javascript"></script>
        <form class=form3 id="addmov" method="post">

        <label for="titleId" >Title</label>
        <input type="text" name="titleId" id="titleId" placeholder="Title">
        <label for="categoryId">Category</label>
        <input type="text" name="categoryId" id="categoryId" placeholder="Category">
        <label for="startId">Start Date</label>
        <input type="date" name="startId" id="startId" placeholder="Start Date">
        <label for="endId">End Date</label>
        <input type="date" name="endId" id="endId" placeholder="End Date">
        <button type="submit" id="btnsubmit" name="btnsubmit" class="addtofav_button" value="ADD MOVIE">Add Movie</button>
        
        </form>
       


        <br>
        <br>
        <br>
        <div class="movies_table" id="moviestable">
            <script src="dltmv.js" type="text/javascript"></script>
            <table align="center" border="1px" style="width:400px; line-height:30px; color:white; ">
            <thead>
                <tr>
                    <th colspan="7"><h2>My Movies</h2></th>
                </tr>
                <tr>                    
                    <th> Title </th>
                    <th> Category </th>
                    <th> Start Date </th>
                    <th> End Date </th>
                    <th> Remove </th>
                    <th> Edit </th>
                </tr>
            </thead>
        
        </br>
        </br>
        </br>

        <?php
           
            $owned = "SELECT * FROM movies WHERE cinemaName = '$u_name'";
            $movs = mysqli_query($conn, $owned);
            
            if(!$movs)
            {
                var_dump(mysqli_error($conn));
                exit;
            }

            while($row=mysqli_fetch_assoc($movs))
            {
           
            echo "<tr>";
            echo "<td>" . $row["title"]."</td>";
          
        
            echo "<td>" . $row["category"]."</td>";
            $movie_id= $row["movie_id"];
            echo "<td>" . $row["startDate"]."</td>";
            echo "<td>" . $row["endDate"]."</td>";

            $url = "deletefrommov.php?movie_id=$movie_id";
            echo "<td>" ."<br><center><a class='link' style=font-size: 28px;  href=#; movid=$movie_id>Remove</a>"."</td>";
            
            $url2 = "editMovie.php?movie_id=$movie_id";
            echo "<td>" ."<br><center><a class='addtofav_button' style=font-size: 28px;  href=$url2>Edit</a>". "</td>";

            echo "</tr>";
        ?>
            


       
        </div>
            





            
            <?php
            }

            
        ?>

        </table>

    </body>


        


</html>  
