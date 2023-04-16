<?php
    // This was deprecated in PHP 5
    // 	$dbhost = 'localhost';
    // 	$dbuser = 'root';
    // 	$dbpass = 'null';
    // 	$db = 'myfirstdatabase';
    //
    // 	$conn = mysql_connect($dbhost,$dbuser,$dbpass);
    // 	mysql_select_db($db);

	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$dbName = "streepapp_db";

	$conn = mysqli_connect($serverName, $userName, $password, $dbName);

	if(mysqli_connect_errno()){
	    echo "Failed to connect!";
	    exit();
	}
?>