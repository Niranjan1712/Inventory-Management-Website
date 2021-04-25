<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
session_start();
$_SESSION["logout"]="message for Logout";
header("location: ../../index");
exit;
?>