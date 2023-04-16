<?php 
	include 'ADMINcheck.php';	//returns user to main site when not admin
	include 'connectDB.php';	//connects to the MySQL database for lookup
	include 'translate.php';	//converts English months to Dutch
?>

<meta charset="utf-8">
<title>Gebruikers</title>
<link href="css/instyle.css" rel="stylesheet" type="text/css" media="screen"/>
</head>

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="slide.js"></script>

<h1><a href="desktop.php"><img src="img/back.png" width="30" height="30" alt=""/></a>
						   Gebruikers
   	<a href="prodList.php">Consumpties</a> 
    <a href="mail.php"    >Mailen</a>
    <a href="debtList.php">Schulden</a>
    <a href="contList.php">Inbox</a>
</h1>
<p><i>Hier onderaan kunnen gebruikers toegevoegd worden. Bij 'aanpassen' kan ook een gebruiker met informatie permanent verwijdert worden.</i></p>

<table width="1000px">
	<tr>
    	<td><b title="Administrator rechten."></b></td>
		<td><b>	naam				</b></td>
		<td><b>	email adres			</b></td>
		<td><b>	wachtwoord			</b></td>
		<td><b>	saldo				</b></td>
   		<td><b>	gebruikt			</b></td>
	</tr>
    <?php
        $query = "SELECT * FROM personalia ORDER BY name ASC";	
        $result = mysqli_query($conn, $query);
    
        while($nextup = mysqli_fetch_array($result)){
			if($nextup['isActive']){
				$date = $nextup['lastused'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month Y";
				if($nextup['isAdmin']){$admin = '<b title="administrator">A</b>';}else{$admin = '';}
				echo "<tr>
					<td style='text-align:center'>" 	 . $admin . "</td>
					<td>" 	 . $nextup['name'] . "</td>
					<td> <a href='mailto:".$nextup['email']."'title='mailto:".$nextup['email']."'>".$nextup['email']."</A> </td>
					<td>"	. $nextup['password'] . "</td>
					<td> € " .number_format ( $nextup['debt'], 2) . "</td>
					<td>" 	 . date($string, strtotime($date)) . "</td>
					<td><button><a href= custModify.php?id=".$nextup['ID'].">Aanpassen</a>" . "</button></td>
					</tr>";
			}
		}
    ?>

    <tr>
    	<form action="custInsert.php" method="post">     
        	<td>    <input type="checkbox" 							  name="isAdmin"/> </td>
            <td>	<input type="text" 								  name="name" 	  placeholder="Voornaam Achternaam"/>								</td>
            <td>	<input type="text" 								  name="email" 	  placeholder="Voor.Achter@VLG.nl"		style="width:12em;"/>		</td>
            <td>	<font color="#9D9D9D"></font>  <input type="text" name="password" placeholder="wachtwood" 				style="width:5em;" />	</b></td>
			<td>	<font color="#9D9D9D">€</font> <input type="text" name="debt" 	  placeholder="0.00" 					style="width:4em;" />	</b></td>
            <td>	<font color="#9D9D9D"><?php   $date = date('d F Y');$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month Y"; echo date($string, strtotime($date)) ?></font></td>
            <td>	<input type="submit" 							  name = "submit" value = "Toevoegen"/></td>
    	</form>
    </tr>
</table>