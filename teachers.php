<?php
include_once "config.php";
?>

<!DOCTYPE html>

<html>

<head>
	<title>Преподаватели в ПМФ</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo time(); ?>">
</head>

<body>
	<h3 align="center">Преподаватели в ПМФ</h3>
	<?php include_once "links.htm"; ?>
	<table border="1" align="center">	
	<tr>
		<td colspan="5">
			<form name="form_course" action="teachers.php" method="get">
				<label for="courses">Избери дисциплина:</label>
				<select name="courses" id="courses">
				   <option value="0">Всички</option>
				   <?php
					$result_courses=mysqli_query($connection,"select * from courses");
				    while($row_course=mysqli_fetch_array($result_courses))
				    {
						echo '<option value='.$row_course['id'];
						if (isset($_GET['courses']) && $_GET['courses']==$row_course['id'])
						{echo ' selected>'.$row_course['name'].'</option>';}
						else {echo '>'.$row_course['name'].'</option>';}
				    }
				  ?>
				</select>
				<input type="submit" value="сортирай">
			</form>
		</td>
	</tr>
	<tr>
		<th>ID</th>
		<th>Име</th>
		<th>Презиме</th>
		<th>Фамилия</th>
		<th>Избираема дисциплина</th>
	</tr>
		<?php
			if (isset($_GET['courses']) && $_GET['courses'] != 0)
			{$result=@mysqli_query($connection,"select * from teachers, courses WHERE teachers.course_id=$_GET[courses] AND courses.id=$_GET[courses];");}
			else 
			{$result=mysqli_query($connection,"select * from teachers, courses WHERE teachers.course_id=courses.id;");}
			if (mysqli_num_rows($result) > 0)
			{  
				while($row_students=mysqli_fetch_array($result))
				{
				  echo 
					'<tr>
						   <td>'.$row_students['id'] .'</td>
						   <td>'.$row_students['fname'].'</td>
						   <td>'.$row_students['mname'].'</td>
						   <td>'.$row_students['lname'].'</td>
						   <td>'.$row_students['name'].'</td>
					</tr>';
				}
			}
			else {echo "Няма записан преподавател към курса";}
		?>
  </table>
  <?php mysqli_close($connection); ?>	
</body>

</html>