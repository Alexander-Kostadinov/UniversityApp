<?php
$username = "moderator"; 
$password = "moderatorpass"; 
$database= "pmf";
$connection = mysqli_connect("localhost", $username, $password) or die(mysqli_error());
mysqli_select_db($connection, $database) or die("Unable to select database");
mysqli_query($connection,"SET NAMES utf8");
?>
