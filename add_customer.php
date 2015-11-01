	<html >
		<META http-equiv="refresh" content="0;URL=customers.php"> </meta>

	<?php

	require('util.php');
	
	$link = mysqli_connect($host, $username, $password, $dbname) or die(mysqli_error($link));
			
	$result = mysqli_query($link,'SELECT * FROM `customers` ') or die(mysqli_error($link));
	
	if (!$result) {
		die(mysqli_error($link));
	}
	
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
	
if(strlen($_FILES['foto']['name']) >0  && (isset($_REQUEST['name']))) {
	
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
		
		$query = 	"INSERT INTO `customers`(`id`, `name`, `last_name`, `otch`, `mail`, `work_phone`, `cell_phone`, `sex`, `birthdate`, `foto`, `job_title`, `company`) VALUES (NULL, '$name', '$last_name' , '$otch', '$mail', '$work_phone', '$cell_phone', '$sex', '$birthdate', '$foto', '$job_title', '$company')";
			
	   	mysqli_query($link, $query) or die(mysql_error($link));
			
		//конец редактирования		
	}elseif (isset($_REQUEST['name'])) { 
		
		$foto = "./uploadimg/404.jpg";
		//Если нет картинки заполняем без нее
	$query = 	"INSERT INTO `customers`(`id`, `name`, `last_name`, `otch`, `mail`, `work_phone`, `cell_phone`, `sex`, `birthdate`, `foto`, `job_title`, `company`) VALUES (NULL, '$name', '$last_name' , '$otch', '$mail', '$work_phone', '$cell_phone', '$sex', '$birthdate', '$foto', '$job_title', '$company')";	//	print($query);
	
		$result = mysqli_query($link, $query) or die(mysql_error($link));
		 if (!$result) {
			 die(mysqli_error($link));
		 }
	}

	mysqli_close($link);

?>
</html>