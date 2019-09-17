<!-- function that eases looking up data from MySQL databare personalia sheet --!>
<?php
include 'connectDB.php';

function isAdmin($ID) {
	$result = mysql_fetch_array(mysql_query("SELECT isAdmin FROM personalia WHERE ID = '$ID'"));
    return $result['isAdmin'];
}

function isActive($ID) {
	$result = mysql_fetch_array(mysql_query("SELECT isActive FROM personalia WHERE ID = '$ID'"));
    return $result['isActive'];
}

function giveName($ID) {	
	$result = mysql_fetch_array(mysql_query("SELECT name FROM personalia WHERE ID = '$ID'"));
	if($result['name']){return $result['name'];}
	else{return "<i><font color='#9D9D9D'>[verwijderd]</i>";}
}

function giveID($name) {	
	$result = mysql_fetch_array(mysql_query("SELECT ID FROM personalia WHERE name = '$name'"));
	return $result['ID'];
}
function giveProduct($ID) {	
	$result = mysql_fetch_array(mysql_query("SELECT prodName FROM products WHERE prodID = '$ID'"));
	if($result['prodName']){return $result['prodName'];}
	else{return "<i><font color='#9D9D9D'>[verwijderd]</i>";}
}

function giveDebt($ID) {	
	$result = mysql_fetch_array(mysql_query("SELECT debt FROM personalia WHERE ID = '$ID'"));
	return $result['debt'];
}
?>