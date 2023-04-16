<!-- adds new user, also possible for non logged in users !-->

<?php
	include 'randIntGen.php'; 
	$ID = randIntLength(8);
	echo($ID);
	if($_POST['name'] && $_POST['email'] && $_POST['password']){
		include 'connectDB.php';
		$name	=	$_POST['name'];
		$email	=	$_POST['email'];
		$password = $_POST['password'];
		$date 	= 	date("Y-m-d H:i:s");

		if(!isset($_POST['isAdmin'])){
			$isAdmin = 0;
		} else {
			$isAdmin = 1;
		}
		if(!isset($_POST['password2'])){
			$password2 = $password;
		} else {
			$password2 = $_POST['password2'];
		}
		
		if(!isset($_POST['debt'])){
			$debt = 0;	
		} else { 
			$debt = $_POST['debt'];
		}	
// 		@mysql_select_db($database);
		
		if($password == $password2){
			$query = "INSERT INTO personalia VALUES('$ID','$name','$email','$password','$debt','$date','$isAdmin','1')";
			mysqli_query($conn, $query) or die(mysql_error());
			
			if(!isset($_COOKIE["deviceID"])){
				setcookie("deviceID",$ID, time()+10000);
				header('Location: index.php');
			}
			if(isset($_COOKIE['deviceID'])){
				header('Location: custList.php');
			}
		} else { 
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else { 
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
?>