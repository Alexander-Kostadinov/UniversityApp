<?php
if (!isset($_SESSION)) { 
  session_start(); 
}
include_once "config.php";
if($_SESSION['user'] !== $username){header("Location:index.php");}

if (isset($_GET['id']))
{
	$result=mysqli_query($connection,"SELECT * FROM courses WHERE id=$_GET[id]");
	$row=mysqli_fetch_array($result);
}
?>

<html>
<head><title>Редактиране на дисциплина</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<table align="center" cellpadding="0" cellspacing="0" width="400" style="margin-top: 5px;">

<form action="edit_course.php" method="post">
	<tr>
		<td height="30" colspan="2"><p align="center"><strong>Редактиране на дисциплина</strong></p>
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>" size=40 class="field">
		</td>
	</tr>
	<tr>
		<td height="30"><p align="center">Име *</p></td>
		<td><input type=text name="name" value="<?php echo $row['name']; ?>" size=40 class="field"></td>
	</tr>
</form>
</table>
	<input class="edit-btn" type="submit" value="Редактиране" class="button" style="margin-top: 20px; font-size: 16px;">
</body>
</html>

