<?php										
if (!isset($_SESSION)) { 
  session_start(); 
}
include "config.php";
if($_SESSION['user'] !== $username){header("Location:index.php");}
?>

<!DOCTYPE html>

<html>
	<head><title>Редактиране на студент</title>
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
				<div height="30" align="center">
					<p class="list-btn">
						<a href="students.php">Списък със студенти</a>
					</p>
				</div>
    			<div align="center" style="margin-top: 50px;">
					<?php	
						if(!empty($_POST['fname']) && !empty($_POST['lname'])) {
							$edit_row="UPDATE students SET fnum='$_POST[fnum]', fname='$_POST[fname]', mname='$_POST[mname]', lname='$_POST[lname]', course='$_POST[course]', lgroup='$_POST[lgroup]', course_id='$_POST[course_id]' WHERE id=$_POST[id]";
							if (@mysqli_query($connection,$edit_row))
								{echo '<p><strong>Данните са редактирани успешно.</strong></p>';}
							else {
								echo '<p><strong>Данните НЕ са редактирани.</strong></p>';
								include_once "edit_student_form.php";
							}					
						}
						else {
							echo '<p><strong>Попълнете задължителните полета!</strong></p>';
							include_once "edit_student_form.php";
						}	
					?>
				</div>
			</div>
		</div>
	</body>

</html>

