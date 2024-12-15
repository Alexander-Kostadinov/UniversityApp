<?php										
//session_start();
if (!isset($_SESSION)) { 
  // no session has been started yet
  session_start(); 
}
include_once "config.php";
if($_SESSION['user'] !== $username){header("Location:index.php");}

if (isset($_GET['id']))
{
	$result=mysqli_query($connection,"SELECT * FROM students WHERE id=$_GET[id]");
	$row=mysqli_fetch_array($result);
}
?>

<html>
<head><title>Редактиране на студент</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table align="center" cellpadding="0" cellspacing="0" width="400">

<form action="edit_student.php" method="post">
	<tr>
		<td height="30" colspan="2"><p align="center" class="red14"><strong>Редактиране на студент</strong></p>
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>" size=40 class="field">
		</td>
	</tr>
	<tr>
		<td height="30" width="200"><p align="left" class="black14">Факултетен номер</p></td>
		<td><input type=text name="fnum" value="<?php echo $row['fnum']; ?>" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Име *</p></td>
		<td><input type=text name="fname" value="<?php echo $row['fname']; ?>" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Презиме</td>
		<td><input type=text name="mname" value="<?php echo $row['mname']; ?>" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Фамилия *</td>
		<td><input type=text name="lname" value="<?php echo $row['lname']; ?>" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Kурс</td>
		<td><select name="course" class="field">
				<?php
				for($i=1; $i<=4; $i++)
				{
					if ($i == $row['course']) 
					{echo '<option value="'.$i.'" selected>'.$i;}
					else
					{echo '<option value="'.$i.'">'.$i;}
					
				}				
				?>
		   </select>
		</td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Лаб.група</td>
		<td><select name="lgroup" class="field">
				<?php
				for($i=1; $i<=4; $i++)
				{
					if ($i == $row['lgroup']) 
					{echo '<option value="'.$i.'" selected>'.$i;}
					else
					{echo '<option value="'.$i.'">'.$i;}
					
				}				
				?>
				</select>
		</td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Избираема дисциплина:</td>
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
	<tr>
		<td height="30" align="center" colspan="2">
		<input type="submit" value="Редактиране" class="button"> </td>
	</tr>
</form></table>
</body>
</html>

