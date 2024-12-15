<?php
if (!isset($_SESSION)) { 
  session_start(); 
}
include_once "config.php";
if($_SESSION['user'] !== $username){header("Location:index.php");}
?>

<!DOCTYPE html>

<html>

	<head>
		<title>Добавяне на нов преподавател</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo time(); ?>">
	</head>

	<body>
		<div class="container">
			<div class="logout">
				<?php
					if(isset($_SESSION['user'])){echo '<p class="black12" align="center">Потребител: <strong>'.$_SESSION['user'].'</strong> - ';}
				?>
				<a href="index.php?logout">
					<strong>Изход</strong>
				</a>
			</div>
			<div style="margin-top: 50px;">
				<div align="center">
					<?php
						if(!empty($_POST['fname']) && !empty($_POST['lname'])) {
							$insert_row="INSERT INTO teachers VALUES('', '$_POST[fname]', '$_POST[mname]','$_POST[lname]', '$_POST[course_id]')";
								if (mysqli_query($connection,$insert_row))
									{echo '<p class="red14"><strong>Новият преподавател е добавен успешно.</strong></p>';}
								else{echo '<p class="red14"><strong>Новият преподавател  НЕ е добавен.</strong></p>';}					
							}
						else{echo '<p class="red14"><strong>Попълнете задължителните полета!</strong></p>';}	
					?>
				</div>
				<p class="list-btn" align="center" style="margin-top: 30px;">
					<a href="teachers.php">Списък с преподаватели</a>
				</p>
    			<div align="center">
					<?php 
						include_once "add_teacher_form.php";
					?>
				</div>
			</div>
		</div>
	</body>

</html>

