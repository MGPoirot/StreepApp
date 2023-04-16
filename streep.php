<!-- script used by Desktop.php and Mobile.php to apply purchases to MySQL database --!>

<?php include 'IDcheck.php';?>

<?php
	include 'connectDB.php';
	if($_POST['product']){
		$prodName = $_POST['product'];
		$productID = mysqli_query($conn, "SELECT prodID FROM products WHERE prodName = '$prodName'");
		$result = mysqli_fetch_array($productID);
	$prodID = $result['prodID'];
	}
	else{
		echo("<br>Er is iets mis gegaan met het product, probeer het opnieuw<br>");
	}
	if($_POST['name']){
		$custName = $_POST['name'];
		$custumerID = mysqli_query($conn, "SELECT ID FROM personalia WHERE name = '$custName'");
		$result = mysqli_fetch_array($custumerID);
	$custID = $result['ID'];
	}
	else{
		echo("<br>Er is iets mis gegaan met de koper, probeer het opnieuw.<br>");
	}
	$devID = $_COOKIE['deviceID'];
		$amount		= $_POST['amount'];	
		
		$date 		= date("Y-m-d H:i:s");
		
			$price 		= mysqli_query($conn, "SELECT prodPrice FROM products WHERE prodID = '$prodID'");
			$result 	= mysqli_fetch_array($price);
		$price 		= floatval($result['prodPrice']);
			
		mysqli_query($conn, "INSERT INTO purchases VALUES(NULL,'$prodID','$custID','$devID','$amount','$date','$price')")	or die(mysql_error());
		
		mysqli_query($conn, "UPDATE products 	SET timessold=  timessold + '$amount' 		WHERE prodID = '$prodID'")		or die(mysql_error());
		mysqli_query($conn, "UPDATE personalia 	SET lastused =  '$date' 			  		WHERE ID = '$custID'")			or die(mysql_error());
		mysqli_query($conn, "UPDATE personalia 	SET debt	 =  debt - '$price' * '$amount'	WHERE ID = '$custID'")			or die(mysql_error());
	
		header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
<br>
<a href="index.php">Home</a>