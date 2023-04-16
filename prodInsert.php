<?php include 'IDcheck.php';?>

<?php
	include 'connectDB.php';
	
	$isActive = $_POST['isActive'];
	$product=$_POST['product'];
	$price=$_POST['price'];	
	$color = $_POST['color'];
	$date = date("Y-m-d H:i:s");
	
	@mysql_select_db($database);
	if($product && $price){
		
		$query = "INSERT INTO products VALUES(NULL,'$product','$price','$color','0','$date','$isActive')";
		mysqli_query($conn, $query);
	}
	header('Location: prodList.php');
	mysql_close();
?>