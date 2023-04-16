<?php 
	include 'connectDB.php';	//connects to the MySQL database for lookup
?> 

<html>
<meta charset="utf-8">
<title>Streep Mobiel</title>
<link href="css/FGL2.css" rel="stylesheet" type="text/css" media="screen"/>
<?php
   if(isset($_COOKIE['deviceID'])){
	    header('Location: mobile.php');
	}
?>
<head>
    <table>
        <tr>
            <td style="text-align: right">
                <form action="desktoplogin.php" method="POST" title="desktop">
                    <input id='sumbit' type='submit' name='desk' value="" style= 'width:175px; background-color:#F7D547; background-image:url(img/pc.png);'>
                </form>
            </td>
            <td style='text-align: center'>
                <form action='loginmobile.php' method="POST" title='saldo' 	   	 	>
                    <input id='sumbit' type='submit' name='list' value="inloggen" style= 'width:100%;border:none; background-color:#44AFD5;'>
                </form>
            </td>
            <td style="text-align: left">
                <form action="addusermobile.php" method="POST" title="logout">
                    <input id='sumbit' type='submit' name='logout' value=""  style= 'width:175px; background-color:#78B54D;background-image:url(img/add.png);'>
                </form>
            </td>
        </tr>
    </table>
</head>

<body>

<form action="loginmobile.php" method="post">
<table>
	<tr>
    	<td>
			<select name="deviceID">
            	<option>naam</option>
				<?php 
                    include 'connectDB.php';
                    $query1 = "SELECT name FROM personalia ORDER BY name";	
                    $result1 = mysqli_query($conn, $query1);
                    while($nextup = mysqli_fetch_array($result1)){
                        echo "<option>" . $nextup['name'] . "</option>";
                    }
                ?>
			</select>
 		</td>
 	</tr>
    <tr>
    	<td>
        	<input type="password"name="password" placeholder="Wachtwoord" style="width:100%; color:white;"/>
        </td>
    </tr>
    <tr>
    	<td>
        	<input type="checkbox"name="remember" checked="yes"/> onthoud mij
        </td>
    </tr>
    <tr>
        <td style="text-align:center">
        	<input type="submit" name="submit" value="inloggen" style= 'width:100%; text-align:center; border:none; background-color:#44AFD5;' >
		</td>
    </tr>
    	<tr>
    	<td>
			 <?php
                $status = ''; 
                if(isset($_POST["password"])){
                    include 'connectDB.php';
                    
                    $name = $_POST["deviceID"];
                    $password = mysqli_query($conn, "SELECT password FROM personalia WHERE name = '$name'");
                    $result = mysqli_fetch_array($password);
                    
                    if(!strcmp($result['password'],$_POST["password"])){
                    	if(isset($_POST['remember'])){
                            $deviceID = mysqli_query($conn, "SELECT ID FROM personalia WHERE name = '$name'");
                            $resultaat = mysqli_fetch_array($deviceID);
                            setcookie("deviceID",strval($resultaat['ID']), time()+10000);
                       	}else{
                           	$deviceID = mysqli_query($conn, "SELECT ID FROM personalia WHERE name = '$name'");
                            $resultaat = mysqli_fetch_array($deviceID);
                            setcookie("deviceID",strval($resultaat['ID']), time()+300);
                        }
                        header('Location: index.php');
                    }
                    else{
                        $status = "<p style='color:red'>Incorrect</p>";
                    }
                }
                echo("<p>" . $status . "</p>");
            ?>
        </td>
    </tr>
</table>
</form>
</body>
</html>
