<?php
	require 'util.php';
	require('head.php');
	//Подключение к базе
?>	
<center >

<div class="center">
	<br/>
<table class="table table-striped" border="0" cellpadding="4" cellspacing="0">

<?php

$link =  mysqli_connect($host, $username, $password, $dbname) or die(mysql_error());
//mysql_connect($host, $username, $password) or die(mysql_error());
//	mysql_select_db($dbname) or die(mysql_error());
	
	//$result = mysql_query('SELECT * FROM `customers` ') or die(mysql_error());
//	$result = mysql_query('SELECT * FROM `customers` ORDER BY `customers`.`company` ASC, `customers`.`last_name` ASC') or die(mysql_error());
$result = mysqli_query($link, "SELECT * FROM `customers` ORDER BY `customers`.`last_name` ASC, `customers`.`company` ASC") or die(mysqli_error($link));

	if (!$result) {
		die(mysql_error());
	}
	
	 		
		 		
	while ($row = mysqli_fetch_row($result)) {
		
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
 //echo ('<td> '); print($row[6]); echo('</td>');
	echo ("<td> <a href=tel:$row[6]> $row[6] </a></td>");
//	echo ("<td> " . "<a href=\"del_customer.php?id=$row[0]\"><img width=\"15\" height=\"15\" src=\"img/del.png\"></a> " . "</td>");
			echo '</tr>';
				
	
	} 
	echo ('</table>' . ' <br/>');
	
	mysqli_close($link);

	require('footer.php');

?>
