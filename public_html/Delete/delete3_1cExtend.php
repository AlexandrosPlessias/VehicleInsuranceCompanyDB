<html>
<head>
	<form><input type="button" value=" Διαγραφή " onClick="window.location.href='/~db1u36/Delete/deleteIndex.php'"></form>
	<title> Διαγραφή 3.1α </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<style>
input[type=button] {
    width: 10em;  
    height: 3em;
    border: 3px solid #a1a1a1;
    border-radius: 25px;
}
</style>

<body bgcolor="white">

<?php 
$host = "localhost"; 
$user = "db1u36"; // <-- Εδώ βάλετε την ομάδα σας  
$pass = "Jy03y9TC"; // <-- Εδώ βάλετε τον κωδικό σας
$db = $user; 
$con = pg_connect("host=$host dbname=$db user=$user password=$pass")or die("Could not connect to server\n");

if(isset($_POST['SubmitBoard'])){ 
	// Παίρνω τις τιμές της φόρμας.
	$per_idTemp = pg_escape_string($_POST['per_id']);
	$veh_idTemp = pg_escape_string($_POST['veh_id']);
			
	// Εντολή για την Διαγραφή από την βάση(ΠΙΝΑΚΑ person).
	$queryDeletePersonWithId = "DELETE FROM person WHERE per_id='$per_idTemp'";
	$rs0 = pg_query($con, $queryDeleteVehicleWithId) or die("Cannot execute queryDeletePersonWithId: $queryDeletePersonWithId\n");
	echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ person)!!<br> 
		";
		
	// Εντολή για την Διαγραφή από την βάση(ΣΧΕΣΗ board).	
	$queryDeleteBoard = "DELETE FROM board WHERE per_id='$per_idTemp'  AND veh_id='$veh_idTemp'"; 
	$rs1 = pg_query($con, $queryDeleteBoard) or die("Cannot execute queryDeleteBoard: $queryDeleteBoard\n");
	echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΣΧΕΣΗ board)!!
		";
}


if(isset($_POST['SubmitNonBoard'])){ 
	// Παίρνω τις τιμές της φόρμας.
	$per_idTemp = pg_escape_string($_POST['per_id']);
	$st_caseTemp = pg_escape_string($_POST['st_case']);
			
	// Εντολή για την Διαγραφή από την βάση(ΠΙΝΑΚΑ person).
	$queryDeletePersonWithId2 = "DELETE FROM person WHERE per_id='$per_idTemp' ";
	$rs0a = pg_query($con, $queryDeletePersonWithId2) or die("Cannot execute queryDeletePersonWithId2: $queryDeletePersonWithId2\n");
	echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ person)!!<br> 
		";
		
	// Εντολή για την Διαγραφή από την βάση(ΣΧΕΣΗ non_board).	
	$queryDeleteNonBoard = "DELETE FROM non_board WHERE per_id='$per_idTemp' AND st_case='$st_caseTemp' "; 
	$rs1a = pg_query($con, $queryDeleteNonBoard) or die("Cannot execute queryDeleteNonBoard: $queryDeleteNonBoard\n");
	echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΣΧΕΣΗ non_board)!!
		";
			
}

pg_close($con);
?>

</body>
</html>