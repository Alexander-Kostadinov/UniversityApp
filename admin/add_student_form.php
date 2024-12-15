<html>
<head><title>Формуляр за добавяне на студент</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8"> 
	<link href="style.css" rel="stylesheet" type="text/css">
	<script>
	function validate_form(){
	valid=true;
	
			if(isNaN(document.add_student.fnum.value))
			{
			valid=false;
			window.alert('В полето Факултетен номер трябва да се въведе число!');
			document.add_student.fnum.focus();
			}
			else if (document.add_student.fname.value=="")
			{
			valid=false;
			window.alert('полето Име е задължително');
			document.add_student.fname.focus();
			}
			else if (document.add_student.lname.value=="")
			{
			valid=false;
			window.alert('полето Фамилия е задължително');
			document.add_student.lname.focus();
			}
			/*else if (document.add_student.lgroup.selectedIndex==-1)
			{
			valid=false;
			window.alert('полето Л.група е задължително');
			document.add_student.lgroup.focus();
			} */
			else
			{
				document.add_student.submit();
			}
			return valid;
	}
	</script>
</head>
<body>
<table align="center" cellpadding="0" cellspacing="0" width="400">
<form action="add_student.php" method="post" name="add_student">
	<tr>
		<td height="30" colspan="2"><p align="center" class="red14"><strong>Добавяне на нов студент</strong></p></td>
	</tr>
	<tr>
		<td height="30" width="200"><p align="left" class="black14">Факултетен номер</p></td>
		<td><input type="text" name="fnum" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Име *</p></td>
		<td><input type="text" name="fname" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Презиме</td>
		<td><input type="text" name="mname" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Фамилия *</td>
		<td><input type="text" name="lname" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Kурс</td>
		<td><select name="course" class="field">
				<option value="1">1</option>
				<option value="2">2</option>
		   		<option value="3">3</option>
		   		<option value="4" selected>4</option>
		   </select>
		</td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Лаб.група</td>
		<td><select name="lgroup" class="field">
				<option value="1">1</option>
				<option value="2" selected>2</option>
		   		<option value="3">3</option>
		   		<option value="4">4</option>
		   </select>
		</td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Избираема дисциплина:</td>
		<td><select name="course_id" class="field">			
		   <?php
			$result_courses=mysqli_query($connection,"SELECT * FROM courses");
			while($row_course=mysqli_fetch_array($result_courses))
		   {
			echo '<option value='.$row_course['id'].'>'.$row_course['name'].'</option>';
		   }
			?>
		</select>
		</td>
	</tr>
	<tr>
		<td height="30" align="right">
			<input type="button" value="Добави" class="button" onClick="validate_form()"></td> 
		<td><input type="reset" value="Отказ" class="button"></td> 
	</tr>
</form></table>
</body>
</html>

