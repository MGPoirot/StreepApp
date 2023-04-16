<?php
	//DIT IS BEVEILIGING, HIJ KIJKT OF JE NOG INGELOGD BENT, OF JE ACCOUNT NOG BESTAAT EN OF JE ADMIN BENT
	if(!isset($_COOKIE['deviceID'])){header('Location: login.php');}
	else{
		include 'connectDB.php';
		$ID = $_COOKIE['deviceID'];
		$IDcheck = mysqli_fetch_array( mysqli_query($conn, "SELECT name FROM personalia WHERE ID = '$ID'"));
		if(empty($IDcheck['name'])){
			echo"ik wil je uitloggen!";
			header('Location: logout.php');
		}
	}
	include 'connectDB.php';
	$devID = $_COOKIE['deviceID'];
	$result = mysqli_fetch_array(mysqli_query($conn, "SELECT isAdmin FROM personalia WHERE ID = '$devID'"));
	if(!$result['isAdmin']){
		header('Location: desktop.php');
	}
?>
