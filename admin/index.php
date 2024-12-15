<!DOCTYPE html>

<?php
session_start();
include_once "config.php";
?>

<html>
 	<head>
		<title> Login </title>
		<meta http-equiv="content-type"content="text/html; charset=utf8">
		<link href="style.css?v=1.0"rel="stylesheet" type="text/css">
	</head>

	<body>
		<?php 
			if(isset($_POST['user']) and isset($_POST['pass']))
			{
				if($_POST['user'] == $username && $_POST['pass'] == $password)
				{
					$_SESSION['user']= $_POST['user'];
					include_once "students.php";
				}
				else {
					include_once "login_form.htm";
					include_once "error.htm";
				}
			}
			else { 
				include_once "login_form.htm";
			}
			if (isset($_GET['logout'])) {
				session_destroy();
			}
		?>
	</body>
</html>