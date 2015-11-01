<?php
	require '../util.php';
	require('../head.php');
	//Подключение к базе
?>	
<center >
<div class="center">
	<br/>
<table class="tab" border="0" cellpadding="6" cellspacing="0">

	<?php
	
	$link = mysqli_connect($host, $username, $password, $dbname) or die(mysqli_error($link));
	
	$result = mysqli_query($link, 'SELECT * FROM `customers` ORDER BY `customers`.`last_name` ASC') or die(mysqli_error($link));
		
	if (!$result) {
		die(mysqli_error());
	}
	
	
		 		
	while ($row = mysqli_fetch_row($result)) {
		
	echo ('<tr> ');
	echo ('<td > ');	
	if ($show_avatar == '1') {
		
		if(strlen($row[9])>0) {
			echo('<img ' . 'src=' . '"../' . $row[9]. '"' . ' class="avatar">');
	}	
		}	 echo('</td>');
	
	echo ("<td colspan=\"3\"><font size=1><b> $row[11] </b></font></br> $row[2]  $row[1] $row[3] </br><font size=1> $row[10] </font>");	; echo('</td>');
	echo ('<td> ');	echo("<a href=\"mailto:$row[4]\">"); print($row[4]); echo('</a></td> ');
	echo ('<td> ');	print($row[5]); echo('</td>');
	echo ('<td> ');	print($row[6]); echo('</td>');
	echo ('<td> ');	print($row[7]); echo('</td>');
	echo ('<td> ');	print($row[8]); echo('</td>');
	echo ('<td> ');	print($row[10]); echo('</td>');
	echo ('<td> ');	print($row[11]); echo('</td>');

	echo ("<td> " . "<a href=\"edit_customer.php?id=$row[0]\"><img width=\"15\" height=\"15\" src=\"../img/edit.png\"></a> " . "</td>");
	echo ("<td> " . "<a href=\"del_customer.php?id=$row[0]\"><img width=\"15\" height=\"15\" src=\"../img/del.png\"></a> " . "</td>");
	
			echo '</tr>';
				
	
	}
	echo ('</table>' . ' <br/>');
	mysqli_close($link);
	?>

	<form method="post" action="add_customer.php" ENCTYPE="multipart/form-data"> 

		<input  type="text" placeholder="Фамилия" name="last_name" required="">
		<input  type="text" placeholder="Имя" name="name" required=""> 
		<input  type="text" placeholder="Отчество" name="otch" required="">
		<input  type="email" placeholder="Email" name="mail" required="">
		
		</br></br>
		<input type="text" placeholder="Должность" name="job_title" required="">
		<input  type="tel"  placeholder="Рабочий телефон" name="work_phone" required="" >
		<input  type="text" placeholder="Мобильный телефон" name="cell_phone" >
		<select name="company" title="text" >
			<option value="Адвокатское бюро г. Москвы Кворум">Адвокатское бюро г. Москвы Кворум</option>
			<option value="ООО Си Пи Эссетс Менеджмент">ООО СИ ПИ Эссетс Менеджмент</option>
			<option value="ООО КДМ Груп">ООО КДМ Груп</option>
		</select>
		
		</br></br>
		<select name="sex" title="text" >
			<option value="1">М</option>
			<option value="0">Ж</option>
		</select>
		
		<input  type="date" name="birthdate" required="">
		<input  type="file"  name="foto">
		
		<input  type="submit" value="Добавить">
		

    </form>
	
	
	<?php
		
	require('../footer.php');

?>
