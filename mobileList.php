<?php 
	include 'IDcheck.php';		//returns user to login when not logged in
	include 'connectDB.php';	//connects to the MySQL database for lookup
	include 'lookup.php';		//imports shorthand for personalia lookup
	include 'translate.php';	//converts English months to Dutch
?>

<html>
<meta charset="utf-8">
<title>Mijn strepenlijst</title>
<link href="css/FGL.css" rel="stylesheet" type="text/css" media="screen"/>

<head>
    <table>
        <tr>
            <td style="text-align: right">
                <form action="desktop.php" method="POST" title="desktop">
                	<input id='sumbit' type='submit' name='desk' value="  " style= 'width:175px; background-color:#F7D547; background-image:url(img/pc.png);'>
				</form>
            </td>
            <td style='text-align: center'>
				<form action='mobile.php' method="POST" title=' <?php echo(giveName($_COOKIE['deviceID']))?>'>
                	<input id='sumbit' type='submit' name='list' value=' <?php $nameArray = explode(' ', giveName($_COOKIE['deviceID']), 2); echo($nameArray[0])?>' style= 'width:100%;border:none; background-color:#44AFD5;'>
                </form>
            </td>
            <td style="text-align: left">
                <form action="logout.php" method="POST" title="logout">  
                    <input id='sumbit' type='submit' name='logout' value="  "  style= 'width:175px; background-color:#D88B47;background-image:url(img/key.png);'>
                </form>
            </td>
        </tr>
    </table>
</head>

<body>
    <table>
        <tr style='font-size:50px;'>
            <td></td>
            <td><b>Wat</b></td>
            <td><b>vanaf</b></td>
            <td><b>Wanneer</b></td>
		<tr>
		<?php
            $result = mysql_query("SELECT * FROM purchases ORDER BY purchDate DESC"); 
            $counter = 0;
            $max = 25;
            while($nextup = mysql_fetch_array($result) and ($counter < $max)){
         	    if($nextup['custID'] == $_COOKIE['deviceID']){
                   $counter++;
                   $adjective = '';
                   if(date('d')==date("d", strtotime($nextup['purchDate']))){		  $date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "H:i";$adjective = 'vandaag ';}
                   elseif((date('d')-1)==date("d", strtotime($nextup['purchDate']))){$date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "H:i";$adjective = 'gisteren  ';}
                   elseif((date('d')-2)==date("d", strtotime($nextup['purchDate']))){$date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "H:i";$adjective = 'eergisteren  ';}  
                   elseif(date('Y')==date("Y", strtotime($nextup['purchDate']))){	  $date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month H:i";}
                   else{														 	  $date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month Y";}
                            
                   $nameArray = explode(' ', giveName($nextup['devID']), 2);
                   echo "<tr style='font-size:50'>
                            <td >" 	. $nextup['purchAmount'] . "</td>
                            <td>" 	. giveProduct($nextup['prodID']) . "</td>
                            <td>" 	. $nameArray[0] . "</td>
                            <td>" 	. "$adjective" . date($string, strtotime($date)) .	 "</td>
                    </tr>";
                }
            }
        ?>
        </tr>
    </table>
</body>
</html>




		
        