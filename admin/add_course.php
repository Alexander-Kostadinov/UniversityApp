<?php
//session_start();
if (!isset($_SESSION)) { 
  // no session has been started yet
  session_start(); 
}
include_once "config.php";
if($_SESSION['user'] !== $username){header("Location:index.php");}
?>
<html>
<head>
	<title>Добавяне на нова дисциплина</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
if(isset($_SESSION['user'])){echo '<p class="black12" align="center">Потребител: '.$_SESSION['user'].' - ';}
?>
<a href="index.php?logout"><strong>Изход</strong></a></p>
<table width="50%"  align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
	<?php
	if(!empty($_POST['name']))
		
	{
		$insert_row="INSERT INTO courses VALUES('', '$_POST[name]')";
		if (mysqli_query($connection,$insert_row))
			{echo '<p class="red14"><strong>Новата дисциплина е добавена успешно.</strong></p>';}
		else{echo '<p class="red14"><strong>Новата дисциплина  НЕ е добавена.</strong></p>';}					
	}
	else{echo '<p class="red14"><strong>Попълнете задължителните полета!</strong></p>';}	
	?></td>
  </tr>
  <tr>
    <td height="30" align="center"><p class="black14"><a href="courses.php">Списък дисциплини</a></p></td>
  </tr>
   <tr>
    <td align="center"><?php include_once "add_course_form.php"; ?></td>
  </tr>
 </table>

</body>
</html>

