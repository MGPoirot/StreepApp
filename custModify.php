<?php 
	include 'connectDB.php';	//connects to the MySQL database for lookup
	include 'ADMINcheck.php';	//returns user to main site when not admin
	if(!isset($_POST['submit']))  {
		$q = "SELECT * FROM personalia WHERE ID = $_GET[id]";
		$result = mysql_query($q);
		$personalia = mysql_fetch_array($result);
	}
?>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="slide.js"></script><head>
        <meta charset="utf-8">
        <title>Bewerken <?php echo $personalia['name'] ?></title>
        <link href="css/instyle.css" rel="stylesheet" type="text/css" media="screen"/>
</head>




<p><h1><a href="custList.php"><img src="img/back.png" width="30" height="30" alt=""/></a> Bewerken <?php echo $personalia['name'] ?></h1></p>

<i>Het verwijderen van een account is permanent.<br>
schulden kunnen aangepast worden bij <u><a style="color:#001DFF" href="debtList.php">schulden</a></u>.</i>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<table width="400x">
   		<tr>
        	<td><p>naam</p></td>
            <td><p><input type="text" name="name"   value="<?php echo $personalia['name'] ?>" style="width:290px;" /></p></td>
        </tr>
        <tr>
        	<td><p>email</p></td>
            <td><p><input type="text" name="email" 	value="<?php echo $personalia['email']   ?>"  style="width:290px;" /></p></td>
		</tr>
        <tr>
        	<td><p>schuld</p></td>
            <td><p>€<?php echo number_format($personalia['debt'],2) ?></td>
		</tr>
        <tr>
        	<td><p>admin</p></td>
            <td><p><input type="checkbox" name="isAdmin" <?php if($personalia['isAdmin']){echo('checked');}  ?>/></td>
		</tr>
	</table>
    <table width="400x">
    	<tr><td><input type= "submit" name = "submit" value = "Pas aan" style="width:363px"/></td></tr>
    	<tr><td><input type= "submit" name = "delete" value = "Verwijder volledig" style="width:363px"/></td></tr>
    </table>
    
	<input type= "hidden" value= "<?php echo $_GET['id']; ?>" name="id" />
</form>

<?php
	if(isset($_POST['submit']))	{
		if(!isset($_POST['isAdmin'])){$isAdmin = 0;}else{$isAdmin = 1;}
		$u = "UPDATE personalia SET `name` = '$_POST[name]', `email` = '$_POST[email]', `isAdmin` = '$isAdmin' WHERE ID = $_POST[id]";
		mysql_query($u) or die(mysql_error());
		header('Location: custList.php');
	}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type= "hidden" value= "<?php echo $_GET['id']; ?>" name="id" />
</form>

<?php
	if(isset($_POST['delete']))	{
		$u = "UPDATE personalia SET `isActive` = 'false' WHERE ID = $_POST[id]";
		mysql_query($u) or die(mysql_error());
		header('Location: custList.php');
	}
?>

