<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start the session
session_destroy(); 
header("Location: index.php"); // Redirect to login page after logout
exit;
?>
