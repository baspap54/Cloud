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
//we take the current user's name
$current_name = $_SESSION["userName"];
$flag = $flag2 =1;
// owner
$sql = "SELECT userName FROM users WHERE id IN(SELECT id FROM user_role WHERE role_id='1' or role_id='3')";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    var_dump(mysqli_error($conn));
    exit;
}
while($rows=mysqli_fetch_assoc($result))
        {
            if($rows['userName']==$current_name){
                $flag = 0;
            }    
        }
//admin 
$sql_2 = "SELECT userName FROM users WHERE id IN(SELECT id FROM user_role WHERE role_id='1' or role_id='2')";
$result_2 = mysqli_query($conn, $sql_2);
if(!$result_2)
{   
    var_dump(mysqli_error($conn));
    exit;
}


while($rows=mysqli_fetch_assoc($result_2))
{
    if($rows['userName']==$current_name){
        $flag2 = 0;    
    }    
}

$role = "SELECT userName FROM users WHERE id IN(SELECT id FROM user_role WHERE role_id='1' )";
$role_result = mysqli_query($conn, $role);

while($role_row=mysqli_fetch_assoc($role_result))
{
    if($role_row['userName']==$current_name){
        $_SESSION["roleName"] = "User";    
    }    
}

$role = "SELECT userName FROM users WHERE id IN(SELECT id FROM user_role WHERE role_id='2' )";
$role_result = mysqli_query($conn, $role);

while($role_row=mysqli_fetch_assoc($role_result))
{
    if($role_row['userName']==$current_name){
        $_SESSION["roleName"] = "Cinema Owner";    
    }    
}

$role = "SELECT userName FROM users WHERE id IN(SELECT id FROM user_role WHERE role_id='3' )";
$role_result = mysqli_query($conn, $role);

while($role_row=mysqli_fetch_assoc($role_result))
{
    if($role_row['userName']==$current_name){
        $_SESSION["roleName"] = "Admin";    
    }    
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
            
        .wrapper{
            
     
            margin: 0 auto;
        }

        .menu-button{
            background-color: transparent;
            color: white;
            padding: 18px;
            font-size: 16px;
            cursor: pointer;
            border: 5px solid #620000;
            font-family: sans-serif;     
        }
        .menu-button2{
            background-color: #620000;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 5px 25px;
            text-decoration: none;
            font-size: 15px;
            font-family: sans-serif;

        }
        .right-menu{
            position: relative;
            display: inline-block;
            float: center;
        }

        .dropdown-menu{
            display: none;
            position: absolute;
            background-color: transparent;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-menu a:hover{
            background-color: #ff0000;
            color: #fff;
        }

        .right-menu:hover .dropdown-menu{
             display: block;
        }
        .right-menu:hover .menu-button{
            background-color: transparent; 
        }

        #admin_button{
            position: auto;
            top:15%;
            left: 21%;
            background-color: #620000;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 11px 50px;
            text-decoration: none;     
            font-family: serif;
            font-size: larger;
        }          
        #admin_button:hover{
            cursor: pointer;
            background:  #ff0000;
            color: #000;
        }

        #owner_button{
            position: auto;
            top:15%;
            left: 23%;
            background-color: #620000;
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 11px 50px;
            text-decoration: none;     
            font-family: serif;
            font-size: larger;
        }          
        #owner_button:hover{
            cursor: pointer;
            background:  #ff0000;
            color: #000;
        }

        .users_table{
            position: fixed;
            top:20%;
            left:40%;
            color: #fff;
            font-size: 20px;
            font-style: normal;
            
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
            font-family:serif;
        }

        .user_role{
            position: relative;
            top: 1000px;
            color: #fff;      
            font-family:serif;
        }
            
        </style>    
    </head>

    <body>
        
        
               
            <h0>PLACEHOLDER</h0>
            <div class="wrapper">
                <div class="right-menu">
                    <button class="menu-button">Menu</button>
                        <div class="dropdown-menu">
            <?php 
            if($flag == 1 || $flag2 == 1){ ?>
            <br><a  class="menu-button2" href="restricted.php">Movies</a><br>
            <?php
            }else{ ?>
            <br><a href="movies.php" class="menu-button2">Movies</a><br>
            <?php
            }
            ?>

           
            
            <?php 
            if($flag == 1){ ?>
                <br><a href="owner.php" class="menu-button2">Owner</a><br>
            <?php
            }else{ ?>
                <br><a href="restricted.php" class="menu-button2">Owner</a><br>
            <?php
            }
            ?>
            <?php 
            if($flag2 == 1){ ?>
            <br><a href="administration.php" class="menu-button2">Administration</a><br>
            <?php
            }else{ ?>
            <br><a href="restricted.php" class="menu-button2">Administration</a><br>
            <?php
            }
            ?>
        </div>
        </div>
        </div>
        <div class="logout_button">
            <a class="logout_button" href="logout.php">Log Out</a>
        </div>

        

        
        <div class="user_name">
            <h1 style="font-size: 17px;font-family: serif;"> &#129409 User: <b><?php echo htmlspecialchars($_SESSION["userName"]); echo("($rName)"); ?></b> </h1>
        </div>       
    </body>
</html>

