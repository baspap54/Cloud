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
$sql = "SELECT * FROM movies";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    var_dump(mysqli_error($conn));
    exit;
}
$rName=$_SESSION["roleName"];

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
        div.display {
            display: inline-block;
        }    
        .formm{
            position: fixed;
            width:  16%;
            height: 10%;
            background-color: hsla(556, 50%, 25%, 0.3);   
            
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

        h3{
            text-align: center;
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
            padding: 7px 35px;
        }

        .movies_table tbody tr{
            border-bottom: 1px solid #000;
            background-color:#a33131;
            color:#fff;
        }

        .favorites_button {
            position:auto;
            top:15%;
            left: 20%;
            background-color: #620000;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 11px 50px;
            text-decoration: none;
            font-family: serif;
            font-size: larger;
        }       
        .favorites_button:hover{
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
        </style>    
    </head>

    <body>  

        <div>       
            <h0>PLACEHOLDER</h0>  
            <a style="font-size: 28px;" class="favorites_button" href="showFavorites.php">Favorites</a>     
        </div>
        
        <div class="back_button">
            <a style="font-size: 28px;" class="back_button" href="welcome.php">Home</a> 
        </div>

        <div class="logout_button">
            <a class="logout_button" href="logout.php">Log Out</a>
        </div>
        
        <div class="user_name">

        <h1 style="font-size: 17px;font-family: serif;"> &#129409 User: <b><?php echo htmlspecialchars($_SESSION["userName"]); echo("($rName)"); ?></b> </h1>
        </div>
        <div class="movies_table" id="moviestable">
            <table align="center" border="1px" style="width:400px; line-height:30px; color:white; ">
            <thead>
                <tr>
                    <th colspan="6"><h2>Movies</h2></th>
                </tr>
                <tr>
                    <th> Title </th>
                    <th> Category </th>
                    <th> Cinema </th>
                    <th> Starting </th>
                    <th> In favorites </th>
                    <th> Add to favorites </th>
                </tr>
            </thead>

           
           
          
        

        <?php
        $where_condition = "SELECT * FROM movies WHERE movie_id >= 0";


      
        if(!empty($_POST['search'])){
            foreach($_POST['search']  as $k=>$v){
                if(!empty($v) and $v!="view_all") {
                
                  $where_condition .= " AND ";
                  
                  switch($k) {
                    case "title":
                      $title = $v;
      
                      $where_condition=$where_condition." title='$title' ";
      
                      break;
                      case "category":
                      $category = $v;
      
                      $where_condition=$where_condition." category='$category' ";
      
                      break;
                    case "cinemaName":
                      $cinemaName = $v;
      
                      $where_condition=$where_condition." cinemaName='$cinemaName' ";
      
                      break;
                    case "startDate":
                      $startDate = $v;
      
                      $where_condition=$where_condition." date(startDate)='$startDate' ";
      
                      break;
      
                   
                    }
      
                }
      
            }
          }
      
            $order_by="ORDER BY title";
            $sql2 = $where_condition." ".$order_by;

            $result_2 = mysqli_query($conn, $sql2);

            
            while($rows=mysqli_fetch_assoc($result_2))
            { 

            echo "<tr>";
            echo "<td>" . $rows["title"]."</td>";
          
        
            echo "<td>" . $rows["category"]."</td>";
            $movie_id= $rows["movie_id"];
            echo "<td>" . $rows["cinemaName"]."</td>";
            echo "<td>" . $rows["startDate"]."</td>";
            $sql3 = "SELECT * FROM favorites WHERE movie_id = $movie_id AND id = $u_id";
            $result_3 = mysqli_query($conn, $sql3);
            if($rows3=mysqli_fetch_assoc($result_3)){
                echo "<td>" . "YES" ."</td>";
            }
            else{
                echo "<td>" . "NO" ."</td>";
            }
            $url = "addtofav.php?movie_id=$movie_id";
            echo "<td>" ."<br><center><a class='link' style=font-size: 28px; class=back_button; href=#; movid=$movie_id>Add/Remove</a>". "</td>";
            echo "</tr>";
       
            ?>
            
            
            </div>
            


            <?php






            }
            
     
  
      ?>
  </table>


<div class="form2">
<h3>Search Filters:</h3>
 <form action="movies.php" method="post">
  <label for="title"><h4>Title:</h4></label>
    <select id="title" name="search[title]">
      <option value="view_all">View All</option>
      <?php 
      $sql = " SELECT DISTINCT title FROM movies";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows ( $result ) > 0) {

        while($row=mysqli_fetch_assoc($result))
        {
           echo "<option value='".$row["title"]."'>".$row["title"]."</option>";
        }
      }
      ?>
      </select>
      <label for="category"><h4>Category:</h4></label>
    <select id="category" name="search[category]">
      <option value="view_all">View All</option>
      <?php 
      $sql = " SELECT DISTINCT category FROM movies";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows ( $result ) > 0) {

        while($row=mysqli_fetch_assoc($result))
        {
           echo "<option value='".$row["category"]."'>".$row["category"]."</option>";
        }
      }
      ?>
      </select><br>
    <label for="cinemaName"><h4>Cinema:</h4></label>
    <select id="cinemaName" name="search[cinemaName]">
      <option value="view_all">View All</option>
      <?php 
      $sql = " SELECT DISTINCT cinemaName FROM movies";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows ( $result ) > 0) {

        while($row=mysqli_fetch_assoc($result))
        {
           echo "<option value='".$row["cinemaName"]."'>".$row["cinemaName"]."</option>";
        }
      }
      ?>
      </select>
  <label for="startDate"><h4>Start Date:</h4></label>
  <input type="date" id="startDate" name="search[startDate]" >
  <div><br><input type="submit" class=addtofav_button value="Search"></br></div>  
  </form>
  </div>



  
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


       

            <script type="text/javascript">
            $(function(){
                $(document).on('click', '.link', function(){
                    var elem = $(this);
              

                    var ajaxReq= $.ajax({
                                    cache: false,
                                    type: "GET",
                                    url: "addtofav.php",
                                    data: "id="+elem.attr('movid')
                                }).fail(function(){
                                    elem.remove();
                                
                                }).done(function(data){
                                    //alert("done");
                                    // $(this).closest('tr').remove();
                                    //ocation.reload ()
                                   
                                    $('#moviestable').load('movies.php' + ' #moviestable');
                                   
                                   
                                });

                    return false;
                });
            });
    </script>
</html>