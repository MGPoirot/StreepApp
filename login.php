<link rel="stylesheet" type="text/css" href="css/outstyle.css">

<title>Login</title>
<link href="css/login.css" rel="stylesheet" type="text/css" media="screen"/>

<body>

<table width="100%" style="float: left; border:none">
<tr><td>

<?php
	if(isset($_COOKIE['deviceID'])){
		header('Location: desktop.php');
	}
	$status = 'Login als een gebruiker'; 
	if(isset($_POST["password"])){
		include 'connectDB.php';
		
		$name = $_POST["deviceID"];
		$password = mysql_query("SELECT password FROM personalia WHERE name = '$name'");
		$result = mysql_fetch_array($password);
		
		if(!strcmp($result['password'],$_POST["password"])){
			if(isset($_POST['remember'])){
				$deviceID = mysql_query("SELECT ID FROM personalia WHERE name = '$name'");
				$resultaat = mysql_fetch_array($deviceID);
				setcookie("deviceID",strval($resultaat['ID']), time()+10000);
			}else{
				$deviceID = mysql_query("SELECT ID FROM personalia WHERE name = '$name'");
				$resultaat = mysql_fetch_array($deviceID);
				setcookie("deviceID",strval($resultaat['ID']), time()+300);
			}
			header('Location: index.php');
		}
		else{
			$status = "<p style='color:#FF0004'>Incorrect wachtwoord </p>";
		}
	}
	echo("<p>" . $status . "</p>");
?>

<form action="login.php" method="post">
	<select name="deviceID">
		<?php 
			include 'connectDB.php';
			$query1 = "SELECT name FROM personalia ORDER BY name";	
			$result1 = mysql_query($query1);
			while($nextup = mysql_fetch_array($result1)){
				echo "<option>" . $nextup['name'] . "</option>";
			}
        ?>
	</select>
    </br>
  	<input type="password"name="password" placeholder="Wachtwoord"/>
    </br>
    <input type="checkbox"name="remember" checked="yes"/> onthoud mij <br>
	<input type="submit" name="submit" value="inloggen" style="width:200px">
</form>
</td><td>
<p>Maak een nieuwe gebruiker aan:</p>


<form action="custInsert.php" method="post">     
	<input type="text" 		name="name" 	placeholder="Voornaam Achternaam"/></br>
	<input type="text" 		name="email" 	placeholder="Voornaam.Achternaam@VaandrigLengtonGroep.nl" style="width:23em;"/></br>
   	<input type="password" 		name="password" 	placeholder="Wachtwoord"/></br>
	<input type="password" 		name="password2" 	placeholder="Herhaal"/></br>
	<input type="checkbox"name="remember" checked="yes"/> onthoud mij <br>
    <input type="submit" name = "submit" value = "Toevoegen" style="width:200px"/>
</form>
</td></tr></table>
</body>