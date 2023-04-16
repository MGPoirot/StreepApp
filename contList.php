<?php 
	include 'ADMINcheck.php';	//returns user to main site when not admin
	include 'connectDB.php';	//connects to the MySQL database for lookup
	include 'lookup.php';		//imports shorthand for personalia lookup
	include 'translate.php';	//converts English months to Dutch
?>

<head>
        <meta charset="utf-8">
        <title>Inbox</title>
        <link href="css/instyle.css" rel="stylesheet" type="text/css" media="screen"/>
</head>

<body>
	<h1><a href="desktop.php"><img src="img/back.png" width="30" height="30" alt=""/></a>
		<a href="custList.php">	Gebruikers</a> 
        <a href="prodList.php">			Consumpties</a>
		<a href="mail.php">	Mailen</a>
		<a href="debtList.php">	Schulden</a>
        						Inbox
	</h1>
<p><i>Hier kunnen berichten gelezen worden die door gebruikers achtergelaten zijn.<br></i></p>
	<?php
            $result = mysqli_query($conn, "SELECT * FROM contact ORDER BY date");
            while($nextup = mysqli_fetch_array($result)){
				$date = $nextup['date'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month Y H:i:s";
                echo	
						"<b><font color=white>" . date($string, strtotime($date)) . " door: ". giveName($nextup['Sender']) . "</font></b><button><a href=delText.php?id=".$nextup['ID'].">Verwijderen</a>" . "</button>
						<table width='1000px'>
					  		<tr style='width:500px'>
					  			<td>". $nextup['text'] . "</td>
							</tr>
						</table>
					</br>";
            }
        ?>
</body>