prod<?php
	include 'IDcheck.php';
	include	'connectDB.php';
	include 'lookup.php';
	include 'translate.php';
?>

<!doctype html>
<html>
<head>
        <meta charset="utf-8">
        <title>Homepage</title>
        <link href="css/outstyle.css" rel="stylesheet" type="text/css" media="screen"/>
</head>

<body>
	 <h1>
     	<a href="mobile.php"><img src="img/back.png" width="30" height="30" alt=""/></a>
    	<a href="desktop.php"> Strepen</a>
        <a href="mylist.php">	Zoeken</a> 
        						Vragen
		<?php if(isAdmin($_COOKIE['deviceID'])){echo('<a href="custList.php"><img src="img/alter.png" width="32" height="32"/></a>');}?>
    </h1>
</body>
</html>
<body>
<table width="550px">
    <form name="myform" action="contact.php" method="POST">
    	<tr>
         	<td align="left">
				<textarea name="text" style="width:542px; height:100px; border:none;" placeholder="Berichten die hier verzonden worden kunnen door een admin gelezen worden."></textarea>	
			</td>
			<td align="right">
				<input type="submit" name="submit" value="Versturen">
            </td>
		</tr>
        <tr>
        	<td>
				<?php
                    if(isset($_POST['text'])){
                        if($_POST['text']){
                            $text=$_POST['text'];
                            $sender= $_COOKIE['deviceID'];
                            $date = date("Y-m-d H:i:s");
                            mysql_query("INSERT INTO contact VALUES(NULL,'$text','$date','$sender')");
                            echo('<i><font color="#9D9D9D">bericht verzonden.</i>');
                        }
						else{
							echo('<i><font color="#9D9D9D">berichtvak leeg.</i>');
						}							
                    }
					else{
						echo('<br>');
					}
                ?>
            </td>
		</tr>
	</form>
</table>
</body>