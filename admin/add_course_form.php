﻿<html>
<head><title>Формуляр за добавяне на студент</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8"> 
	<link href="style.css" rel="stylesheet" type="text/css">
	<script>
	function validate_form(){
	valid=true;
	
			if (document.add_course.name.value=="")
			{
			valid=false;
			window.alert('полето Име е задължително');
			document.add_course.name.focus();
			}
			else
			{
				document.add_course.submit();
			}
			return valid;
	}
	</script>
</head>
<body>
<table align="center" cellpadding="0" cellspacing="0" width="400">
<form action="add_course.php" method="post" name="add_course">
	<tr>
		<td height="30" colspan="2"><p align="center" class="red14"><strong>Добавяне на нова дисциплина</strong></p></td>
	</tr>
	<tr>
		<td height="30"><p align="left" class="black14">Име *</p></td>
		<td><input type="text" name="name" size=40 class="field"></td>
	</tr>
	<tr>
		<td height="30" align="right">
			<input type="button" value="Добави" class="button" onClick="validate_form()"></td> 
		<td><input type="reset" value="Отказ" class="button"></td> 
	</tr>
</form></table>
</body>
</html>

