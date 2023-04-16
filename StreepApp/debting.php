<?php include 'ADMINcheck.php';?>
<?php
	$devID = $_COOKIE['deviceID'];
	$result = mysqli_fetch_array(mysqli_query($conn, "SELECT isAdmin FROM personalia WHERE ID = '$devID'"));
	if($result['isAdmin']){
		include 'connectDB.php';
		$result = mysqli_query($conn, "SELECT ID FROM personalia ORDER BY ID ASC");
		while($nextup = mysqli_fetch_array($result)){
			$custID = $nextup['ID'];
			$add = $_POST[$custID];
			mysqli_query($conn, "UPDATE personalia 	SET debt =  debt + '$add' WHERE ID = '$custID'") or die(mysql_error());
			if($add != 0){
				$type		= "debtList"; 
				$date 		= date("Y-m-d H:i:s");
				$editor 	= $_COOKIE['deviceID'];
				$subject	= $nextup['ID'];
				$object		= $add;
				mysqli_query($conn, "INSERT INTO logs VALUES(NULL,'$type','$date','$editor','$subject','$object')")	or die(mysql_error());
			}
		}
		header('Location: debtList.php');
	}
?>
