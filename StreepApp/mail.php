<?php 
	include 'ADMINcheck.php';
	include 'connectDB.php';
	include 'translate.php';
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
		Mailen
		<a href="debtList.php">	Schulden</a>
        <a href="contList.php"> Inbox </a>
	</h1>
<i>Hier gaan we een automatisch mailsysteem bouwen!<br></i>


<table>
	<form method="post">
	<tr>
    	<td>
             <input type="text" name="message" value="Hello World!">
		</td>
    </tr>
	<tr>
    	<td>
            <input type="submit" name="message" value="opslaan">
		</td>
    </tr>
    </form>
</table>
 
                        
<?php 
	if(isset($_POST['message'])){
		echo('mailverzonden');
		$to = "m.poirot@hetnet.nl";
		$subject = "Test";
		$message = "Hello World!";
		mail($to,  $subject, $message);
	}
?>
</body>