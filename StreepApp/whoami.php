<!-- Used for debugging only. Returns account name and admin status as plain html of currently logged in account though coockie check. !-->

<?php
	include 'lookup.php';
	
	echo("You are " . giveName($_COOKIE["deviceID"]) . " your ID is " . $_COOKIE['deviceID']. " and ");	

	if(isAdmin($_COOKIE["deviceID"])){
		echo('you rule as an wise administrator!');
	}
	else{
		echo('sadly, you are not an administrator.');
	}
?>
