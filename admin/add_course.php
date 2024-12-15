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
		<title>Добавяне на нова дисциплина</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8">
		<link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo time(); ?>">
	</head>

	<body>
		<div class="container">
			<div class="logout">
        		<?php 
					if(isset($_SESSION['user'])) { 
            			echo '<p>Потребител: <strong>'.$_SESSION['user'].'</strong> - '; 
        			} 
				?>
        		<a href="index.php?logout">
					<strong>Изход</strong>
				</a>
    		</div>
			<div style="margin-top: 50px;">
				<div align="center">
					<?php
						if(!empty($_POST['name'])) {
							$insert_row="INSERT INTO courses VALUES('', '$_POST[name]')";
							if (mysqli_query($connection,$insert_row))
								{echo '<p class="red14"><strong>Новата дисциплина е добавена успешно.</strong></p>';}
							else {echo '<p class="red14"><strong>Новата дисциплина  НЕ е добавена.</strong></p>';}					
						}
						else{echo '<p class="red14"><strong>Попълнете задължителните полета!</strong></p>';}	
					?>
				</div>
				<p class="list-btn" align="center" style="margin-top: 30px;">
					<a href="courses.php">Списък с дисциплини</a>
				</p>
    			<div align="center">
					<?php 
						include_once "add_course_form.php";
					?>
				</div>
			</div>
		</div>
	</body>

</html>

