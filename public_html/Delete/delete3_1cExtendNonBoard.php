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

if(isset($_POST['SubmitStcase'])){ 
	// Παίρνω την τιμή της φόρμας.
	$st_caseTemp = pg_escape_string($_POST['st_case']);
			
	// Εντολή για την Διαγραφή από την βάση(ΠΙΝΑΚΑ accident).
	$queryDeleteAccidentWithId = "DELETE FROM accident WHERE '$st_caseTemp' = st_case";
	$rs2 = pg_query($con, $queryDeleteAccidentWithId) or die("Cannot execute queryDeleteAccidentWithId: $queryDeleteAccidentWithId\n");
	echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ accident)!!<br> 
		";
			
pg_close($con);
}
?>

</body>
</html>