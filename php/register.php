<?php   
    require_once "config.php";
    $userName = "";
    $password = "";
    $name = "";
    $role = "";
    $confirmed = 0;
   
    $surname = ""; 
    $email = ""; 
   
    $userNameErr = $passwordErr = $nameErr = $surnameErr = $emailErr = $roleErr = "";
 
   
    $role_id = 1;
    $role_name = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate username
        if (isset($_POST["userName"]))
        {   
            if(empty(trim($_POST["userName"]))){
                $userNameErr = "Please enter a username.";
            } else{
                // Prepare a select statement
                $sql = "SELECT id FROM users WHERE userName = ?";

                if($stmt = mysqli_prepare($conn, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_username);

                    // Set parameters
                    $param_username = trim($_POST["userName"]);

                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);

                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $userNameErr = "This username is already taken.";
                        } else{
                            $userName = trim($_POST["userName"]);
                        }
                    } else{
                        echo "username error.";
                    }
                }
            }
        }
        else 
        {
            $userName = null;
            echo "no username supplied";
        }

        if(empty(trim($_POST["password"]))){
            $passwordErr = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $passwordErr = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);            
            }


        if(empty(trim($_POST["name"]))){
            $nameErr = "Please enter your name.";
        }
        else{
            $name = trim($_POST["name"]);
        }

        if(empty(trim($_POST["email"]))){
            $emailErr = "Please enter your email address.";
        }
        else{
            $email = trim($_POST["email"]);
        }

        if(empty(trim($_POST["surname"]))){
            $surnameErr = "Please enter your surname.";
        }
        else{
            $surname = trim($_POST["surname"]);
        }

        if(empty(trim($_POST["role"]))){
            $roleErr = "Please enter your role.";
        }
        else{
            if(trim($_POST["role"])=='user'){
                $param_role_id = 1;
            }
            elseif(trim($_POST["role"])=='owner'){
                $param_role_id =2; }
            elseif(trim($_POST["role"])=='admin'){
                $param_role_id =3;}
            else{
                $roleErr = "Please choose between user, owner or admin";
            }
        }
       
        
        // Check input errors before inserting in database
        if(empty($userNameErr) && empty($passwordErr) && empty($nameErr) && empty($surnameErr) && empty($emailErr)&& empty($roleErr)){
            $sql = "INSERT INTO user_role (id, role_id) VALUES (?,?)";
            if($stmt = mysqli_prepare($conn, $sql)){
                    // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ii", $param_id, $param_role_id);

                $result = mysqli_query($conn, "SELECT id FROM users where userName = $userName");
		        $param_id = $result;
         
            }
             
           
            // Prepare an insert statement
            $sql = "INSERT INTO users (userName, password, name, surname, email, confirmed) VALUES (?, ?, ?, ?, ?, ?)";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssssi", $param_username, $param_password, $param_name, $param_surname, $param_email, $confirmed);

                // Set parameters
                $param_username = $userName;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_name = $name;
                $param_surname = $surname;
                $param_email = $email;
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    $lastId = mysqli_insert_id ($conn);
                    $sql = "INSERT INTO user_role (id, role_id) VALUES (?,?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ii", $param_id, $param_role_id);

		                $param_id = $lastId;
		             
		                if(mysqli_stmt_execute($stmt)){
                            header("location: index.php");             
		                    mysqli_stmt_close($stmt);          
                        }   
                    }   
                }
                
            }
        
        }
        // Close connection
        mysqli_close($conn); 
    } 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PLACEHOLDER</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
          
          
    <body>
        <h0>PLACEHOLDER</h0>
               
        <div class="form">
            
            
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1>Sign Up</h1>
                
                <p>Username</p>                
                <input type="text" class="form-control" value="<?php echo $userName; ?>" name="userName" placeholder="Enter Username">
                <span class="help-block">
                    <?php 
                        $Color = "red"; 
                        echo '<div style="Color:'.$Color.'">'.$userNameErr.'</div>'; 
                    ?>
                </span>
                
                
                <p>Password</p>
                <input type="password" class="form-control" value="<?php echo $password; ?>" name="password" placeholder="Enter Password">
                <span class="help-block">
                    <?php 
                        $Color = "red"; 
                        echo '<div style="Color:'.$Color.'">'.$passwordErr.'</div>'; 
                    ?>
                </span>

                <p>Name</p>                
                <input type="text" class="form-control" value="<?php echo $name; ?>" name="name" placeholder="Enter your name">
                <span class="help-block">
                    <?php 
                        $Color = "red"; 
                        echo '<div style="Color:'.$Color.'">'.$nameErr.'</div>'; 
                    ?>
                </span>

                <p>Surname</p>                
                <input type="text" class="form-control" value="<?php echo $surname; ?>" name="surname" placeholder="Enter Surname">
                <span class="help-block">
                    <?php 
                        $Color = "red"; 
                        echo '<div style="Color:'.$Color.'">'.$surnameErr.'</div>'; 
                    ?>
                </span>

                <p>Email</p>                
                <input type="text" class="form-control" value="<?php echo $email; ?>" name="email" placeholder="Enter your email address">
                <span class="help-block">
                    <?php 
                        $Color = "red"; 
                        echo '<div style="Color:'.$Color.'">'.$emailErr.'</div>'; 
                    ?>
                </span>

                <p>Role</p>                
                <input type="text" class="form-control" value="<?php echo $role; ?>" name="role" placeholder="Enter your role(user, owner, admin)">
                <span class="help-block">
                    <?php 
                        $Color = "red"; 
                        echo '<div style="Color:'.$Color.'">'.$roleErr.'</div>'; 
                    ?>
                </span>
                <span class="help-block">
                <button>Sign Up</button>
                </span>
                <div class="space">           
                    <p class="message">Already Registered? <a href="index.php">Login</a></p>
                </div>    
            </form>   
        </div>     
    </body>  
</html>
