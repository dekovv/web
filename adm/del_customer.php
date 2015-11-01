<?php
	require('../util.php');

//	mysql_connect($host, $username, $password) or die(mysql_error());
//	mysql_select_db($dbname) or die(mysql_error());
	$link = mysqli_connect($host, $username, $password, $dbname) or die(mysqli_error($link));
		
	$query_text = "DELETE FROM `doc`.`customers` WHERE `customers`.`id` = " . $_REQUEST['id'];
	mysqli_query($link, $query_text) or die(mysqli_error($link));
	mysqli_close($link);
?>

<html>
	<head >
	<META http-equiv="refresh" content="0;URL=customers.php">
	</head>
	<body>
	</body>
</html>