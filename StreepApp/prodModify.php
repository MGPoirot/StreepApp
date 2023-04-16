<?php include 'ADMINcheck.php';?>

<?php
	include 'connectDB.php';
	if(!isset($_POST['submit']))  {
		$q = "SELECT * FROM products WHERE prodID = $_GET[id]";
		$result = mysqli_query($conn, $q);
		$product = mysqli_fetch_array($result);
	}
?><head>
        <meta charset="utf-8">
        <title>Bewerken <?php echo $product['prodName'] ?></title>
        <link href="css/instyle.css" rel="stylesheet" type="text/css" media="screen"/>
</head>



<h1><a href="desktop.php"><img src="img/back.png" width="30" height="30" alt=""/></a>
	<a href="custList.php">Gebruikers</a> 
   						   Consumpties 
    <a href="prodList.php">Mailen</a>
    <a href="prodList.php">Schulden</a>
</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<table width="300px">
   		<tr>
        	<td width="118"><p>product</p></td>
            <td></td>
            <td width="170"><p><input type="text" name="product"   value="<?php echo $product['prodName'] ?>" /></p>
        </tr>
        <tr>
        	<td><p>prijs</p></td> 
            <td><p>€</p></td> 
            <td><p><input type="text" name="price" 	value="<?php echo number_format($product['prodPrice'],2) ?>" /></p></td>
		</tr>
		<tr>
        	<td><p>kleur</p></td> 
			<td></td>
            <td><p><input type="color" name="color" value="<?php echo $product['colorHex'] ?>"/></p></td>
		</tr>		<tr>
        	<td><p>actief</p></td> 
			<td></td>
            <?php if($product['isActive']){$activity = 'checked';}else{$activity = '';} ?>
            <td><p><input type="checkbox" name="isActive"  <?php echo $activity ?> /></p></td>
		</tr>
	</table>
    <table width="300px">
    	<tr><td><input type= "submit" name = "submit" value = "Pas aan" style="width:290px"/></td></tr>
        <!--><tr><td><input type= "submit" name = "delete" value = "Verwijder volledig" style="width:290px"/></td></tr>
    </table>
	<input type= "hidden" value= "<?php echo $_GET['id']; ?>" name="id" />
</form>

<?php
	if(isset($_POST['submit']))	{
		if(!isset($_POST['isActive'])){$isActive = 0;}else{$isActive = 1;}
		$u = "UPDATE products SET `prodName` = '$_POST[product]', `prodPrice` = '$_POST[price]', `colorHex` = '$_POST[color]', `isActive` = '$isActive' WHERE prodID = $_POST[id]";
		mysqli_query($conn, $u) or die(mysql_error());
		header('Location: prodList.php');
	}		 
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type= "hidden" value= "<?php echo $_GET['id']; ?>" name="id" />
</form>
<?php
	if(isset($_POST['delete']))	{
		$d = "UPDATE products SET `isActive` = 'false' WHERE prodID = $_POST[id]";
		mysqli_query($conn, $d) or die(mysql_error());
		header('Location: prodList.php');
	}		 
?>

