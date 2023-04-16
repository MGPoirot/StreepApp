<!-- page for desktop users !-->
<?php 
	include 'IDcheck.php';		//returns user to login when not logged in
	include 'connectDB.php';	//connects to the MySQL database for lookup
	include 'lookup.php';		//imports shorthand for personalia lookup
	include 'translate.php';	//converts English months to Dutch
?>

	
<!doctype html>
<meta charset="utf-8">
<title>Strepen</title>
<link href="css/outstyle.css" rel="stylesheet" type="text/css" media="screen"/>

    <h1>
    	<a href="mobile.php"><img src="img/mob.png" width="30" height="30" alt=""/></a>
    		          			Strepen
        <a href="mylist.php">	Zoeken</a> 
        <a href="contact.php">	Vragen</a>
		<?php if(isAdmin($_COOKIE['deviceID'])){echo('<a href="custList.php"><img src="img/alter.png" width="32" height="32"/></a>');}
        ?>
    </h1>
</head>

<body>
<?php if(!isset($_POST['max'])){$max = 20;}else{$max = $_POST['max'];}?>
<table>
	<tr>
    	<td>
        	<?php echo("<b>Welkom " . giveName($_COOKIE['deviceID']) ."!</b>");?>
		</td>
		<form action="desktop.php" method="post">
		<td>
        	<select name="max" >
                <option><?php echo $max;?></option>
                <?php if($max !=  20){echo"<option>20</option>";} ?>
                <?php if($max !=  40){echo"<option>40</option>";} ?>
                <?php if($max !=  80){echo"<option>80</option>";} ?>
                <?php if($max != 160){echo"<option>160</option>";} ?>
                <?php if($max != 320){echo"<option>320</option>";} ?>
			</select>
		</td>
		<td>
        	<input type="submit" name="retable" value="zoek">
		</td>
		</form>
		<form action="logout.php" method="post">
    	<td>
        	<input type="submit" name="logout" value="logout">
       	</td>
		</form>
    </tr>
</table>

<table>
	<tr>
		<td><i>	voor		</i></td>
		<td><i>	#			</i></td>
		<td><i>	consumptie	</i></td>
		<td><i>	tijd		</i></td>
	</tr>
	<tr>
    	<form action="streep.php" method="post">
        <td>
        	<select name="name"><?php
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
        	<select name="amount"  style="font-size:17px;width:100%;"><?php
				for ($i = 1; $i <= 10; $i++) {
					echo "<option>" . $i . "</option>";
				}
			?></select>
        </td>
		<td>
        	<select name="product" style="font-size:17px;width:100%"><?php
				$query = "SELECT * FROM products ORDER BY timessold DESC";	
				$result = mysqli_query($conn, $query);
                while($nextup = mysqli_fetch_array($result)){
					echo "<option>" . $nextup['prodName']."</option>";
				}
             ?></select>
		</td>
		<td>
        	<input type="submit" name="streep" value="streep"style="width:75%"><br>
		</td>
        </form>
        <td><?php
            $result = mysqli_query($conn, "SELECT * FROM purchases ORDER BY purchDate DESC");
			$counter = 0;
			if(!isset($max)){$max = 25;}
            while($nextup = mysqli_fetch_array($result) and ($counter < $max)){
				$counter++;
				$adjective = '';
				if(date('d')==date("d", strtotime($nextup['purchDate']))){		  $date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "H:i";$adjective = 'vandaag ';}
				elseif((date('d')-1)==date("d", strtotime($nextup['purchDate']))){$date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "H:i";$adjective = 'gisteren  ';}
				elseif((date('d')-2)==date("d", strtotime($nextup['purchDate']))){$date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "H:i";$adjective = 'eergisteren  ';}  
				elseif(date('Y')==date("Y", strtotime($nextup['purchDate']))){	  $date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month H:i";}
				else{														 	  $date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month Y H:i";}

				echo "<tr>
						<td>" 	. giveName($nextup['custID']) . "</td>
						<td>" 	. $nextup['purchAmount'] . "</td>
						<td>" 	. giveProduct($nextup['prodID']) . "</td>
						<td>" 	. "$adjective" . date($string, strtotime($date)) .	 "</td>
				</tr>";
			}
		?></td>
	</tr>
</table>
</body>
</html>











