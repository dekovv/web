<?php
	require('util.php');
	include('head.php');

	$link = mysqli_connect($host, $username, $password, $dbname) or die(mysqli_error($link));
	
	
	
	if(strlen($_FILES['foto']['name']) >0  && (isset($_REQUEST['name']))) {
	
	$name = trim($_REQUEST['name']);
	$last_name = trim($_REQUEST['last_name']);
	$otch = trim($_REQUEST['otch']);	
	$mail = trim($_REQUEST['mail']);
	$work_phone = trim($_REQUEST['work_phone']);
	$cell_phone = trim($_REQUEST['cell_phone']);
	$sex = $_REQUEST['sex'];	
	$birthdate = $_REQUEST['birthdate'];
	$foto = $_REQUEST['foto'];
	$job_title = $_REQUEST['job_title'];
	$company = $_REQUEST['company'];
	
	
		$uploaddir = './uploadimg/';
		$uploadfile = $uploaddir . basename($_FILES['foto']['name']);
		if (file_exists($uploaddir) && is_writable($uploaddir)) {echo "<font size=1>ok</font>";} else echo "Болт вам";
		
		//echo $uploadfile;
		if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
		//echo "Файл корректен и был успешно загружен.\n"; //Проверка при ОК
		$foto = $uploadfile;
    
		} else {
		echo "Возможная атака с помощью файловой загрузки!\n </br>";
	
		}	
		
		$query = "UPDATE `doc`.`customers` SET `name` = '" . $name ."', `last_name` = '" . $last_name . "', `otch` = '" . $otch . "', `mail` = '" . $mail . "', `work_phone` = '" . $work_phone ."', `cell_phone` = '" . $cell_phone . "', `sex` = '" .$sex . "', `birthdate` = '" . $birthdate . "', `foto` = '" . $foto . "' ,  `job_title` = '" . $job_title . "', `company` = '" . $company . "' WHERE `customers`.`id` = " . $_REQUEST[id] . ";";
	
	   	mysqli_query($link, $query) or die(mysql_error($link));
			
		//конец редактирования		
	}elseif (isset($_REQUEST['name'])) { 
	$name = trim($_REQUEST['name']);
	$last_name = trim($_REQUEST['last_name']);
	$otch = trim($_REQUEST['otch']);	
	$mail = trim($_REQUEST['mail']);
	$work_phone = trim($_REQUEST['work_phone']);
	$cell_phone = trim($_REQUEST['cell_phone']);
	$sex = $_REQUEST['sex'];	
	$birthdate = $_REQUEST['birthdate'];
	$foto = $_REQUEST['foto'];
	$job_title = $_REQUEST['job_title'];
	$company = $_REQUEST['company'];
	
		
		//Если нет картинки заполняем без нее
		$query = "UPDATE `doc`.`customers` SET `name` = '" . $name ."', `last_name` = '" . $last_name . "', `otch` = '" . $otch . "', `mail` = '" . $mail . "', `work_phone` = '" . $work_phone ."', `cell_phone` = '" . $cell_phone . "', `sex` = '" .$sex . "', `birthdate` = '" . $birthdate . "', `job_title` = '" . $job_title . "', `company` = '" . $company . "' WHERE `customers`.`id` = " . $_REQUEST[id] . ";";
	
	//	print($query);
	
		$result = mysqli_query($link, $query) or die(mysql_error($link));
		 if (!$result) {
			 die(mysqli_error($link));
		 }
	}

	
	
	//print_r($_REQUEST);
?> 
	
<center >
<div class="center">
	<br/>
<table border="0" cellpadding="6" cellspacing="0">

<?php 	
		
	$query = 'SELECT * FROM `customers` WHERE `id` =' . $_REQUEST[id];
		
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
		
	if (!$result) {
		die(mysqli_error());
	}
	 		
	while ($row = mysqli_fetch_row($result)) {
	

	$name = trim($row[1]);
	$last_name = trim($row[2]);
	$otch = trim($row[3]);
	$mail = trim($row[4]);
	$work_phone = trim($row[5]);
	$cell_phone = trim($row[6]);
	$sex = $row[7];	
	$birthdate = $row[8];
	$foto = $row[9];
	$job_title = $row[10];
	$company = $row[11];
	
		
	echo ('<tr> ');
	echo ('<td > ');	
	if ($show_avatar == '1') {
		
		if(strlen($row[9])>0) {
			echo('<img ' . 'src=' . '"' . $row[9]. '"' . ' class="avatar">');
	}	
		}	 echo('</td>');
	
	echo ("<td colspan=\"3\"><font size=1><b> $row[11] </b></font></br> $row[2]  $row[1] $row[3] </br><font size=1> $row[10] </font>");	; echo('</td>');
	echo ('<td> ');	echo("<a href=\"mailto:$row[4]\">"); print($row[4]); echo('</a></td> ');
	echo ('<td> ');	print($row[5]); echo('</td>');
	echo ('<td> ');	print($row[6]); echo('</td>');

	echo ("<td> " . "<a href=\"customers.php\"><img width=\"15\" height=\"15\" src=\"img/list.png\"></a> " . "</td>");	
	echo ("<td> " . "<a href=\"edit_customer.php?id=$row[0]\"><img width=\"15\" height=\"15\" src=\"img/edit.png\"></a> " . "</td>");
	echo ("<td> " . "<a href=\"del_customer.php?id=$row[0]\"><img width=\"15\" height=\"15\" src=\"img/del.png\"></a> " . "</td>");
	
			echo '</tr>';
				
	
	}
	echo ('</table>' . ' <br/>');

?>	
		
	</br></br><center>
	<form method="post" action="" ENCTYPE="multipart/form-data"> 

		<input  type="text" placeholder="Фамилия" value="<?php echo ($last_name)?>"  name="last_name" required="">
		<input  type="text" placeholder="Имя" value="<?php echo ($name)?>" name="name" required=""> 
		<input  type="text" placeholder="Отчество" value="<?php echo ($otch)?>" name="otch" required="">
		<input  type="email" placeholder="Email"  value="<?php echo ($mail)?>" name="mail" required="">
		
		</br></br>
		<input type="text" placeholder="Должность" value="<?php echo ($job_title)?>" name="job_title" required="">
		<input  type="tel"  placeholder="Рабочий телефон" value="<?php echo ($work_phone)?>" name="work_phone" required="" >
		<input  type="text" placeholder="Мобильный телефон" value="<?php echo ($cell_phone)?>" name="cell_phone" >
		<select name="company" value="<?php echo ($company)?>" title="text" >
			<option value="Адвокатское бюро г. Москвы Кворум">Адвокатское бюро г. Москвы Кворум</option>
			<option value="ООО Си Пи Эссетс Менеджмент">ООО СИ ПИ Эссетс Менеджмент</option>
			<option value="ООО КДМ Груп">ООО КДМ Груп</option>
		</select>
		
		</br></br>
		<select name="sex" title="text" >
			<option value="1">М</option>
			<option value="0">Ж</option>
		</select>
		
		<input  type="date" value="<?php echo ($birthdate)?>" name="birthdate" required="">
		<input  type="file"  name="foto">
		
		<input  type="submit" value="Добавить">
		

    </form>
	<?php
	
	require('footer.php');
	mysqli_close($link);

	?>
