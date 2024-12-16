<?php
if (!isset($_SESSION)) { 
  session_start(); 
}
include_once "config.php";
if($_SESSION['user'] !== $username){header("Location:index.php");}

if (isset($_GET['id']))
{
	$result=mysqli_query($connection,"SELECT * FROM teachers WHERE id=$_GET[id]");
	$row=mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>

<html>
<head><title>Редактиране на студент</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table align="center" cellpadding="0" cellspacing="0" width="400" style="margin-top: 5px;">

<form action="edit_teacher.php" method="post">
	<tr>
		<td height="30" colspan="2"><p align="center"><strong>Редактиране на преподавател</strong></p>
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>" size=40 class="field">
		</td>
	</tr>
	<tr>
		<td height="30"><p align="center">Име *</p></td>
		<td><input type=text name="fname" value="<?php echo $row['fname']; ?>" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30"><p align="center">Презиме</td>
		<td><input type=text name="mname" value="<?php echo $row['mname']; ?>" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30"><p align="center">Фамилия *</td>
		<td><input type=text name="lname" value="<?php echo $row['lname']; ?>" size=40 class="field"></td>
	</tr>
	
	<tr>
		<td height="30"><p align="center">Избираема дисциплина:</td>
		<td><select name="course_id" class="field">
		   <?php
		   $result_courses=@mysqli_query($connection,"SELECT * FROM courses");
		   while($row_course=@mysqli_fetch_array($result_courses))
		   {
		   	if ($row_course['id'] == $row['course_id']) 
				{echo '<option value="'.$row_course['id'].'" selected>'.$row_course['name'];}
			else
				{echo '<option value="'.$row_course['id'].'">'.$row_course['name'];}
		   }
		  ?>
		</select>
		</td>
	</tr>
</form>
</table>
	<input class="edit-btn" type="submit" value="Редактиране" class="button" style="margin-top: 20px; font-size: 16px;">
</body>
</html>

