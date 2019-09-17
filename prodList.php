<?php 
	include 'ADMINcheck.php';
    include 'connectDB.php';
	include 'translate.php';
?>

<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="slide.js"></script>

<head>
        <meta charset="utf-8">
        <title>Consumpielijst</title>
        <link href="css/instyle.css" rel="stylesheet" type="text/css" media="screen"/>
</head>
<body>
	<h1><a href="desktop.php"><img src="img/back.png" width="30" height="30" alt=""/></a>
		<a href="custList.php">Gebruikers</a> 
                                      Consumpties 
		<a href="mail.php">Mailen</a>
		<a href="debtList.php">Schulden</a>
        <a href="contList.php">	Inbox</a>
	</h1>

    <p><i>Hier onderaan kunnen producten toegevoegd worden. Bij 'aanpassen' kan ook een product met informatie permanent verwijdert worden. 'kleur' slaat op de kleur van de tegel in mobiele weergave.</i></p>

    <table width="1000px">
        <tr>
        	<td><b>					</b></td>
            <td><b>	product			</b></td>
            <td><b>	prijs			</b></td>
            <td><b>	keren verkocht	</b></td>
            <td><b>	laast verkocht	</b></td>
            <td><b> kleur			</b></td>
            <td><b>	aanpassen		</b></td>
        </tr>
        <?php
            $query = "SELECT * FROM products";	
            $result = mysql_query($query); 
        
            while($nextup = mysql_fetch_array($result)){
				$date = $nextup['lastsold'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month Y H:i";
                if($nextup['isActive']){$active = '<b title="actief">A</b>';}else{$active = '';}
				echo "<tr>
						<td>" . $active . "</td>
                        <td>" 		. $nextup['prodName'] . "</td>
                        <td> € " .number_format ( $nextup['prodPrice'], 2) . "</td>
                        <td>" 		. $nextup['timessold'] . "</td>
                    	<td>" 	 . date($string, strtotime($date)) . "</td>
						<td style='color:". $nextup['colorHex'] ."'>" 	 . $nextup['colorHex'] . "</td>
                        <td><button><a href=prodModify.php?id=".$nextup['prodID'].">Aanpassen</a>" . "</button></td>
                </tr>";
            }
        ?>
        <tr >
            <form action="prodInsert.php" method="post">  
            	<td><input type="checkbox" checked name="isActive"/> </td>
                <td><input type="text" name="product" placeholder="product"/></td>
                <td><font color="#9D9D9D">€</font>	<input type="text" name="price" placeholder="0.00"/></td>
                <td><font color="#9D9D9D">0</font></td>
                <td><font color="#9D9D9D"><?php   $date = date('d F Y H:i');$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month Y H:i"; echo date($string, strtotime($date)) ?></font>	</b></td>
                <td><input type="color" name="color" value="#E07BDA"/></td>
                <td><input type="submit" name = "submit" value = "Toevoegen"/></td>
            </form>
        </tr>
    </table>
</body>