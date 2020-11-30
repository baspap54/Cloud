<?php 

$host = 'db';
$user = 'username';
$password = 'password';
$conn = 'my_database';

$conn = mysqli_connect($host, $user, $password, $conn);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}


//sundesh me palia DB
//docker exec -i mysqlCont mysql -uusername -ppassword my_database < my_database.sql

//mysqli_close($conn);
?>