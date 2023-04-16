<!-- script that logs out by clearing cookies --!>

<?php
	echo($_COOKIE['deviceID']);
	setcookie("deviceID", 'NULL' , time()-3600);
  	unset($_COOKIE['deviceID']);
  	header('Location: index.php');
?>