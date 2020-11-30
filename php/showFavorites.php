<?php
// Include config file
require_once "config.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$u_id = $_SESSION["id"];

$sql = "SELECT * FROM favorites as a join movies as b WHERE (a.movie_id = b.movie_id) AND a.id = $u_id";
$result = mysqli_query($conn, $sql);

if(!$result)
{
    var_dump(mysqli_error($conn));
    exit;
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
        }

        .movies_table tbody tr{
            border-bottom: 1px solid #000;
            background-color:#a33131;
            color:#fff;
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
        .movies_button {
            position: auto;
            top:15%;
            left: 21%;
            background-color: #620000;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            text-decoration: none;
            padding: 11px 50px;
            font-family: serif;
            font-size: larger;
        }         
        .movies_button:hover{
            cursor: pointer;
            background:  #ff0000;
            color: #000;
        }
    

            
        </style>    
    </head>

    <body>  
        <div class="form">       
            <h0>PLACEHOLDER</h0>      
            <a style="font-size: 28px;" class="movies_button" href="movies.php">Movies</a> 
        </div>

        <div class="back_button">
            <a style="font-size: 28px;" class="back_button" href="welcome.php">Home</a> 
        </div>

        <div class="logout_button">
            <a class="logout_button" href="logout.php">Log Out</a>
        </div>
        <div id="message"></div>
        <div class="user_name">

        <h1 style="font-size: 17px;font-family: serif;"> &#129409 User: <b><?php echo htmlspecialchars($_SESSION["userName"]); echo("($rName)"); ?></b> </h1>
        </div>

         <div class="movies_table">
            <table id="tableid" align="center" border="1px" style="width:400px; line-height:30px; color:white; ">
            <thead>
                <tr>
                    <th colspan="4"><h2>Favorites</h2></th>
                </tr>      
                    <th> Title </th>
                    <th> Category </th>
                    <th> Cinema </th>
                    <th> Remove </th>
                </tr>
            </thead>
            <?php
            while($row=mysqli_fetch_assoc($result))
            {
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $row["title"]."</td>";
          
        
            echo "<td>" . $row["category"]."</td>";
            $movie_id= $row["movie_id"];
            echo "<td>" . $row["cinemaName"]."</td>";

            $url = "deletefromfav.php?movie_id=$movie_id";
            echo "<td>" ."<br><center><a class='link' style=font-size: 28px; class=back_button; href=#; movid=$movie_id>Remove</a>". "</td>";
            echo "</tr>";
            echo "</tbody>";
            ?>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


       

            <script type="text/javascript">
            $(function(){
                $('.link').click(function(){
                    var elem = $(this);
              

                    var ajaxReq= $.ajax({
                                    type: "GET",
                                    url: "deletefromfav.php",
                                    data: "id="+elem.attr('movid')
                                }).fail(function(){
                                    elem.remove();
                         
                                }).done(function(data){
                                    //alert("done");
                                    // $(this).closest('tr').remove();

                                   elem.closest("tr").remove();
                                });

                    return false;
                });
            });
            </script>


            <?php





            }
           
            ?>


            </table>
        </div>
        
        
        
        
    </body>
</html>