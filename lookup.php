<!-- function that eases looking up data from MySQL databare personalia sheet --!>
<?php


function isAdmin($ID) {
    include 'connectDB.php';
	$result = mysqli_fetch_array(mysqli_query($conn, "SELECT isAdmin FROM personalia WHERE ID = '$ID'"));
    return $result['isAdmin'];
}

function isActive($ID) {
    include 'connectDB.php';
	$result = mysqli_fetch_array(mysqli_query($conn, "SELECT isActive FROM personalia WHERE ID = '$ID'"));
    return $result['isActive'];
}

function giveName($ID) {
    include 'connectDB.php';
	$result = mysqli_fetch_array(mysqli_query($conn, "SELECT name FROM personalia WHERE ID = '$ID'"));
	if(isset($result['name'])){
	    return $result['name'];
	}
	else{return "<i><font color='#9D9D9D'>[verwijderd]</i>";}
}

function giveID($name) {
    include 'connectDB.php';
	$result = mysqli_fetch_array(mysqli_query($conn, "SELECT ID FROM personalia WHERE name = '$name'"));
	return $result['ID'];
}
function giveProduct($ID) {
    include 'connectDB.php';
	$result = mysqli_fetch_array(mysqli_query($conn, "SELECT prodName FROM products WHERE prodID = '$ID'"));
	if($result['prodName']){return $result['prodName'];}
	else{return "<i><font color='#9D9D9D'>[verwijderd]</i>";}
}

function giveDebt($ID) {
    include 'connectDB.php';
	$result = mysqli_fetch_array(mysqli_query($conn, "SELECT debt FROM personalia WHERE ID = '$ID'"));
	return $result['debt'];
}
?>