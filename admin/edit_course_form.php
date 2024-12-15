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
<table align="center" cellpadding="0" cellspacing="0" width="400">

<form action="edit_course.php" method="post">
	<tr>
		<td height="30" colspan="2"><p align="center" class="red14"><strong>Редактиране на дисциплина</strong></p>
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>" size=40 class="field">
		</td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Име *</p></td>
		<td><input type=text name="name" value="<?php echo $row['name']; ?>" size=40 class="field"></td>
	</tr>

	<tr>
		<td height="30" align="center" colspan="2">
		<input type="submit" value="Редактиране" class="button"> </td>
	</tr>
</form></table>
</body>
</html>

