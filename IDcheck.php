<?php
		//DIT IS BEVEILIGING, HIJ KIJKT OF JE NOG INGELOGD BENT EN OF JE ACCOUNT NOG BESTAAT 
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

 ?>