<html>
<head>
	<form><input type="button" value=" Διαγραφή " onClick="window.location.href='/~db1u36/Delete/deleteIndex.php'"></form>
	<title> Διαγραφή 3.1β </title>
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
	$veh_idTemp = pg_escape_string($_POST['veh_id']);
	$st_caseTemp = pg_escape_string($_POST['st_case']);
			
	// Εντολή για την Διαγραφή από την βάση(ΠΙΝΑΚΑ vehicle).
	$queryDeleteVehicleWithId = "DELETE FROM vehicle WHERE '$veh_idTemp' = veh_id";
	$rs2 = pg_query($con, $queryDeleteVehicleWithId) or die("Cannot execute queryDeleteVehicleWithId: $queryDeleteVehicleWithId\n");
	echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ vehicle)!!<br> 
		";
		
	// Εντολή για την Διαγραφή από την βάση(ΣΧΕΣΗ involve).	
	$queryDeleteΙnvolve = "DELETE FROM involve WHERE '$st_caseTemp' = st_case AND '$veh_idTemp'=veh_id "; 
		$rs1 = pg_query($con, $queryDeleteΙnvolve) or die("Cannot execute queryDeleteΙnvolve: $queryDeleteΙnvolve\n");
		echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΣΧΕΣΗ involve)!!
			";
		

			
pg_close($con);
}
?>

</body>
</html>