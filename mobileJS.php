<!DOCTYPE html>
<html>
<meta charset="utf-8">
<title>Streep Mobiel</title>
<link href="css/FGL.css" rel="stylesheet" type="text/css" media="screen"/>

<head>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>
<body>

<?php 
	//include 'IDcheck.php';
	include 'connectDB.php';
	include 'lookup.php';
	include 'translate.php';
?> 


<div data-role="page" id="Strepen">
   <div data-role="main" class="ui-content">
    <p>Klik2Flip</p>
    <a href="#Lijst" data-transition="flip">Yay</a>
    <table>
        <tr>
            <td style="text-align: right">
                <form action="desktop.php" method="POST" title="desktop">
                    <input id='sumbit' type='submit' name='desk' value="" style= 'width:175px; background-color:#F7D547; background-image:url(img/pc.png);'>
                </form>
            </td>
            <td style='text-align: center'>
                <form action='mobileList.php' method="POST" title='saldo' 	   	 	>
                    <input id='sumbit' type='submit' name='list' value=<?php echo("€".number_format ( giveDebt($_COOKIE['deviceID']), 2))?> style= 'width:100%;border:none; background-color:#44AFD5;'>
                </form>
            </td>
            <td style="text-align: left">
                <form action="logout.php" method="POST" title="logout">
                    <input id='sumbit' type='submit' name='logout' value=""  style= 'width:175px; background-color:#D88B47;background-image:url(img/key.png);'>
                </form>
            </td>
        </tr>
    </table>
<form action="streep.php" method="post">
    <table>
        <tr>
			<td>
                <select name="name" title="op kosten van">
                    <?php
                        echo "<option>" . giveName($_COOKIE['deviceID']) . "</option>";
                        $result1 = mysqli_query($conn, "SELECT name FROM personalia ORDER BY lastused DESC");
                        while($nextup = mysqli_fetch_array($result1)){
                            if($nextup['name'] != giveName($_COOKIE['deviceID'])){
                                echo "<option>" .$nextup['name'] . "</option>";
                            }
                        }
                    ?>   
                </select >
            </td>
            <td>
                <select name="amount" style="width:100%" title="aantal">
                    <?php for ($i = 1; $i <= 24; $i++) {echo "<option>" . $i . "</option>";}?>
                </select>
            </td>
        </tr>
    </table>
		<?php
            $num_rows = mysql_num_rows(mysql_query(mysqli_query($conn, "SELECT * FROM products"));
            $rows = round($num_rows / 2);
            $result = mysqli_query($conn, "SELECT * FROM products ORDER BY timessold DESC");
            while($nextup = mysqli_fetch_array($result)){
                echo "<input 
							id='sumbit' 
							type='submit' 
							name='product' 
							value="  . $nextup['prodName']. " 
							style='height:". ((100/$rows)-(25/$rows)) ."%; 
							background-color:".$nextup['colorHex']."'
						>";
			}
        ?>
    </table>
</form>
  </div>
</div> 

<div data-role="page" id="Lijst">
   <div data-role="main" class="ui-content">
    <p>Pls bring me back</p>
    <a href="#Strepen">OK!!</a>
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
    <table>
        <tr style='font-size:50px;'>
            <td></td>
            <td><b>Wat</b></td>
            <td><b>vanaf</b></td>
            <td><b>Wanneer</b></td>
		<tr>
		<?php
            $result = mysqli_query($conn, "SELECT * FROM purchases ORDER BY purchDate DESC");
            $counter = 0;
            $max = 25;
            while($nextup = mysqli_fetch_array($result) and ($counter < $max)){
         	    if($nextup['custID'] == $_COOKIE['deviceID']){
                   $counter++;
                   $adjective = '';
                   if(date('d')==date("d", strtotime($nextup['purchDate']))){		  $date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "H:i";$adjective = 'vandaag ';}
                   elseif((date('d')-1)==date("d", strtotime($nextup['purchDate']))){$date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "H:i";$adjective = 'gisteren  ';}
                   elseif((date('d')-2)==date("d", strtotime($nextup['purchDate']))){$date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "H:i";$adjective = 'eergisteren  ';}  
                   elseif(date('Y')==date("Y", strtotime($nextup['purchDate']))){	  $date = $nextup['purchDate'];$month = addcslashes(translate_names(date('F', strtotime($date))), 'a..zA..Z');$string = "d $month";}
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

  </div>
</div> 

</body>
</html>