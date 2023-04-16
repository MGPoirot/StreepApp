<?php 
	include 'IDcheck.php';		//returns user to login when not logged in
	include 'connectDB.php';	//connects to the MySQL database for lookup
	include 'lookup.php';		//imports shorthand for personalia lookup
	include 'translate.php';	//converts English months to Dutch
?> 

<html>
<meta charset="utf-8">
<title>Streep Mobiel</title>
<link href="css/FGL.css" rel="stylesheet" type="text/css" media="screen"/>

<head>
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
</head>

<body>
<form action="streep.php" method="post">
    <table>
        <tr>
			<td>
        	<select name="name" title="op kosten van"><?php
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
                <select name="amount" style="width:100%" title="aantal">
                    <?php for ($i = 1; $i <= 24; $i++) {echo "<option>" . $i . "</option>";}?>
                </select>
            </td>
        </tr>
    </table>
		<?php
            $num_rows = mysql_num_rows(mysqli_query($conn, "SELECT * FROM products WHERE isActive"));
            $rows = round($num_rows / 2);
            $result = mysqli_query($conn, "SELECT * FROM products ORDER BY timessold DESC");
            while($nextup = mysqli_fetch_array($result)){
				if($nextup['isActive']){
					echo "<input 
								id='sumbit' 
								type='submit' 
								name='product' 
								value="  . $nextup['prodName']. " 
								style='height:". ((100/$rows)-(25/$rows)) ."%; 
								background-color:".$nextup['colorHex']."'
							>";
				}
			}
        ?>
    </table>
</form>
</body>
</html>
