<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// mysqli_connect("localhost","root","","subscribers");
define('DB_SERVER', 'host');
define('DB_USERNAME', 'db_username');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'database_name');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

