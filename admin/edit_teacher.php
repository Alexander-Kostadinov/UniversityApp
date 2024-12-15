<?php										
//session_start();
if (!isset($_SESSION)) { 
  // no session has been started yet
  session_start(); 
}
include "config.php";
if($_SESSION['user'] !== $username){header("Location:index.php");}
?>

<html>
<head><title>Редактиране на студент</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
if(isset($_SESSION['user'])){echo '<p class="black12" align="center">Потребител: '.$_SESSION['user'].' - ';}
?>
<a href="index.php?logout"><strong>Изход</strong></a></p>
<table align="center" cellpadding="0" cellspacing="0" width="400">
 <tr>
    <td height="30" align="center"><p class="black14"><a href="teachers.php">Списък студенти</a></p></td>
  </tr>
<tr>
    <td align="center">
	<?php	
	if(!empty($_POST['fname']) && !empty($_POST['lname']))
	{
		$edit_row="UPDATE teachers SET fname='$_POST[fname]', mname='$_POST[mname]', lname='$_POST[lname]', course_id='$_POST[course_id]' WHERE id=$_POST[id]";
		if (@mysqli_query($connection,$edit_row))
			{echo '<p class="red14"><strong>Данните са редактирани успешно.</strong></p>';}
		else{
			echo '<p class="red14"><strong>Данните НЕ са редактирани.</strong></p>';
			include_once "edit_teacher_form.php";
			}					
	}
	else
	{
		echo '<p class="red14"><strong>Попълнете задължителните полета!</strong></p>';
		include_once "edit_teacher_form.php";
	}	
	?></td>
  </tr>
 
</table>
</body>
</html>

