<?php 
	include 'IDcheck.php';		//returns user to login when not logged in
	include 'connectDB.php';	//connects to the MySQL database for lookup
	include 'lookup.php';		//imports shorthand for personalia lookup
	include 'translate.php';	//converts English months to Dutch
?>

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="slide.js"></script>

<meta charset="utf-8">
        <title>Gebruikers</title>
        <link href="css/instyle.css" rel="stylesheet" type="text/css" media="screen"/>
</head>

<h1><a href="desktop.php"><img src="img/back.png" width="30" height="30" alt=""/></a>
	<a href="custList.php">Gebruikers</a> 
   	<a href="prodList.php">Consumpties</a> 
    <a href="mail.php"	 >Mailen</a>
    					   Schulden
    <a href="contList.php">Inbox</a>
</h1>
<p><i>Links kunnen meerdere schulden tegelijkertijd veranderd worden. Rechts
wordt hiervan een notitie gemaakt.</i></p>
<table width="50%" style="float: left;">
	<form action='debting.php' style='height:0px;' method="POST">
	<tr>
		<td><b>	naam				</b></td>
        <td></td>
		<td style='text-align:right'><b>	saldo				</b></td>
     
        <td style='text-align:right'><b> bedrag	 			</b></td>
        <td><b><input type="submit" name="submit"></b></td>
	</tr>
    <?php
        include 'connectDB.php';
        $query = "SELECT * FROM personalia ORDER BY name ASC";	
        $result = mysqli_query($conn, $query);
        while($nextup = mysqli_fetch_array($result)){
            echo "
			<tr>
				<td>" 	 . $nextup['name'] . "</td>
				<td>€</td>
				<td style='text-align:right'> " .number_format ( $nextup['debt'], 2) . "</td>
				<td><font color='#9D9D9D'>€<input type='text' name='". $nextup['ID'] ."' placeholder='0.00' style='text-align:right;width:60' ></input></td>
			</tr>";
        }
    ?>
	<tr>
		<td><b>	naam				</b></td>
        <td></td>
		<td style='text-align:right'><b>	saldo				</b></td>
     
        <td style='text-align:right'><b> bedrag	 			</b></td>
        <td><b><input type="submit" name="submit"></b></td>
	</tr>
    </form>
</table>
<table width="50%" style="float: right;">
	<tr>
		<td><b>	datum				</b></td>
		<td><b>	admin				</b></td>
        <td><b> gebruiker	 		</b></td>
		<td><b> bedrag	 			</b></td>
	</tr>
    <?php
		$counter = 0;
        $result = mysqli_query($conn, "SELECT * FROM logs ORDER BY date DESC");
        while($nextup = mysqli_fetch_array($result) and $counter < 17){
			$counter++;
				if(date('d')==date("d", strtotime($nextup['date']))){	$date = $nextup['date'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "H:i";}
				else{													$date = $nextup['date'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month";}
					echo "
					<tr>
						<td>" 	.  date($string, strtotime($date)) .	 "</td>
						<td>" 	 . giveName($nextup['editor']) . "</td>
						<td>" 	 . giveName($nextup['subject']) . "</td>
						<td>€</td>
						<td>" 	 . number_format ( $nextup['object'], 2) . "</td>
					</tr>";
					
        }
    ?>
</table>
