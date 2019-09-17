<?php 
	include 'connectDB.php';	//connects to the MySQL database for lookup
?> 

<html>
<meta charset="utf-8">
<title>Streep Mobiel</title>
<link href="css/FGL2.css" rel="stylesheet" type="text/css" media="screen"/>

<head>
    <table>
        <tr>
            <td style="text-align: right">
                <form action="desktop.php" method="POST" title="desktop">
                    <input id='sumbit' type='submit' name='desk' value="" style= 'width:175px; background-color:#F7D547; background-image:url(img/pc.png);'>
                </form>
            </td>
            <td style='text-align: center'>
                <form action='addusermobile.php' method="POST" title='saldo' 	   	 	>
                    <input id='sumbit' type='submit' name='list' value="nieuw" style= 'width:100%;border:none; background-color:#44AFD5;'>
                </form>
            </td>
            <td style="text-align: left">
                <form action="loginmobile.php" method="POST" title="logout">
                    <input id='sumbit' type='submit' name='logout' value=""  style= 'width:175px; background-color:#78B54D;background-image:url(img/key.png);'>
                </form>
            </td>
        </tr>
    </table>
</head>
<body style="background-color:black">
<table>
<form action="custInsert.php" method="post">
	<tr><td><input type="text" 			name="name" 		placeholder="Voor Achter"/></td></tr>
	<tr><td><input type="text" 			name="email" 		placeholder="Voor.Achter@VaandrigLengtonGroep.nl"/></td></tr>
   	<tr><td><input type="password" 		name="password" 	placeholder="Wachtwoord"/></td></tr>
	<tr><td><input type="password" 		name="password2" 	placeholder="Herhaal"/></td></tr>
	<tr><td><input type="checkbox"		name="remember" 	checked="yes"/> onthoud mij</td></tr>
    <tr><td><input type="submit" 		name="submit" 		value = "Toevoegen" style="background-color:#78B54D; width:100%;"/></td></tr>
</form>
</table>
</body>


</body>
</html>
