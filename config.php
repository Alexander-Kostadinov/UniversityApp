<?php
$username = "user"; 
$password = "userpass";
$database= "pmf";
$connection = mysqli_connect("localhost", $username, $password) or die(mysqli_error("Unable to connect"));
mysqli_select_db($connection, $database) or die("Unable to select database");
mysqli_query($connection,"SET NAMES utf8");
?>
