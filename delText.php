<?php include 'IDcheck.php'; ?>

<?php
		include 'connectDB.php';

		$d = "DELETE FROM contact  WHERE ID = $_GET[id]";
		mysqli_query($conn, $d) or die(mysql_error());
		header('Location: contList.php');
			 
?>

