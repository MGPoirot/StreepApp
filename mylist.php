	<?php 
	include 'IDcheck.php';
	include 'connectDB.php';
	include 'lookup.php';
	include 'translate.php';
?> 

<!doctype html>
<html>
        <meta charset="utf-8">
        <title>Homepage</title>
        <link href="css/outstyle.css" rel="stylesheet" type="text/css" media="screen"/>
<head>
	<h1>
	<a href="mobile.php">  <img src="img/back.png" width="30" height="30" alt=""/></a>
	<a href="desktop.php"> Strepen</a>
                           Zoeken 
	<a href="contact.php"> Vragen</a>
	<?php if(isAdmin($_COOKIE['deviceID'])){echo('<a href="custList.php"><img src="img/alter.png" width="32" height="32"/></a>');}?>
	</h1>
</head>
<?php
	if(!isset($_POST['name'])){		
		$qID = $_COOKIE['deviceID'];
		$qname= giveName($_COOKIE['deviceID']);
	}
	else{
		$qID= giveID($_POST['name']);
		$qname = $_POST['name'];
	}
	if(!isset($_POST['newmax'])){$newmax = date('Y-m-d');}else{$newmax = $_POST['newmax'];}
	if(!isset($_POST['oldmax'])){$oldmax = date('Y-m-d', time()-691200);}else{$oldmax = $_POST['oldmax'];}
?>

<body>

<table>
	<tr>
    	<td>
    		<slideTop><b>zoeken</b></slideTop>
        </td>
    </tr>
	<tr>
    	<form action="mylist.php" name="NameSelector" method="post">
    		<td>
            	<input type="datetime" name="oldmax" value= <?php echo($oldmax);?>>
            </td>
			<td>
            	<input type="datetime" name="newmax" value= <?php echo($newmax);?>>
            </td>
        	<td>
        	<select name="name" style="width:180px"><?php
				echo "<option>" . giveName($_COOKIE['deviceID']) . "</option>";
				$result1 = mysqli_query($conn, "SELECT ID FROM personalia ORDER BY lastused DESC");
				while($nextup = mysqli_fetch_array($result1)){
					if(isActive($nextup['ID']) and $nextup['ID'] != $_COOKIE['deviceID']){
						echo "<option>" . giveName($nextup['ID']) . "</option>";
					}
				}
			?></select >
			</td>
			<td>
            	<input type="submit" name="submit" value="zoek"><br>
			</td>
		</form>
	</tr>
</table>
<table>
	<tr>
    	<td>
    		<b>gekocht</b>
        </td>
    </tr>	
    <tr>
    	<td><i>	tijd		</i></td>
		<td><i>	# 			</i></td>
		<td><i>	consumptie	</i></td>
		<td><i>	prijs		</i></td>
        <td><i> door		</i></td>
        <td><i> voor		</i></td>
	</tr>
    <tr>
        <?php
			$NoResult = true;
			$result = mysqli_query($conn, "SELECT * FROM purchases ORDER BY purchDate DESC");
			while($nextup = mysqli_fetch_array($result)){
				$measuredate = date("Y-m-d", strtotime($nextup['purchDate']));
				if($measuredate >= $oldmax and $measuredate <= $newmax){
					if($qname == 'iedereen' or $qID==$nextup['custID']){
						$NoResult = false;
						echo "<tr>
								<td>" 	. date("d-m-Y H:i", strtotime($nextup['purchDate'])) . "</td>
								<td>" 	. $nextup['purchAmount'] . "</td>
								<td>" 	. giveProduct($nextup['prodID']) . "</td>
								<td>" 	. "- €" . number_format($nextup['purchPrice'],2) . "</td>	
								<td>" 	. giveName($nextup['devID']) . "</td>
								<td>" 	. giveName($nextup['custID']) . "</td>
							</tr>";
					}
				}
			}
			if($NoResult){echo("<tr><td><i><font color='#9D9D9D'>Geen resultaten. Heb je de data wel correct ingevuld?</font></i></td></tr>");}
		?>
	</tr>
</table>
<table>
	<tr>
    	<td>
    		<b>gestort</b>
        </td>
    </tr>
	<tr>
		<td><i>	datum				</i></td>
		<td><i>	admin				</i></td>
        <td><i> voor		 		</i></td>
		<td><i> bedrag	 			</i></td>
	</tr>
    <?php
		$counter = 0;
        $result = mysqli_query($conn, "SELECT * FROM logs ORDER BY date DESC");
        while($nextup = mysqli_fetch_array($result) and $counter < 17){
			if(giveName($nextup['subject']) == $qname or $qname == 'iedereen'){
				$measuredate = date("Y-m-d", strtotime($nextup['date']));
				if($measuredate >= $oldmax and $measuredate <= $newmax){
					$counter++;
						echo "
						<tr>
							<td>" 	.  date("d-m-Y H:i", strtotime($nextup['date'])) .	 "</td>
							<td>" 	 . giveName($nextup['editor']) . "</td>
							<td>" 	 . giveName($nextup['subject']) . "</td>
							<td>+ €</td>
							<td>" 	 . number_format ( $nextup['object'], 2) . "</td>
						</tr>";
					}
			}
        }
    ?>
</table>
</body>