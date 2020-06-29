<html>
<head>
	<form><input type="button" value=" Εισαγωγή " onClick="window.location.href='/~db1u36/Insert/insertIndex.php'"></form> 
	<title> Εισαγωγή 3.1β </title>
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
pg_close($con); 
?>


<h2> Εισαγωγή 3.1β </h2>
<p>Εισαγωγή στοιχείων Οχημάτων:</p>

<form align="left" action="insert3_1b.php" method="post">
	<table align="left">
				
		<tr><td>Accident id:</td> <td><input type="number" name="st_case"></td></tr>
		<tr><td>On board persons:</td> <td><input type="number" name="numoccs" required></td></tr>
		<tr><td>Help the people of the accident:</td> <td><input type="number" name="hit_run" required></td></tr>			
		<tr><td>Registry state:</td> <td><input type="number" name="reg_stat" required></td></tr>			
		<tr><td>Owner:</td> <td><input type="number" name="owner" required></td></tr>			
		<tr><td>Manufactured company:</td> <td><input type="number" name="make" required></td></tr>			
		<tr><td>Manufactured year of vehicle:</td> <td><input type="number" name="mod_year" required></td></tr>			
		<tr><td>Carrying dangerous material:</td> <td><input type="number" name="haz_inv" required></td></tr>		
		<tr><td>Speed:</td> <td><input type="number" name="trav_sp" required></td></tr>			
		<tr><td>Level of damage:</td> <td><input type="number" name="deformed" required></td></tr>			
		<tr><td>Speed accident reason:</td> <td><input type="number" name="speedrel" required></td></tr>			
		<tr><td>Dead people:</td> <td><input type="number" name="deaths" required></td></tr>			
		<tr><td>Drunk driver:</td> <td><input type="number" name="dr_drink" required></td></tr>
		<tr><td> </td><td><input type="Submit" name="Submit" value="Submit"></td></tr>
		
	</table>	
</form>	

<br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
	
<?php
if(isset($_POST['Submit'])){ 
		
	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")or die("Could not connect to server\n");
	
	// Παίρνω το μεγαλύτερο ID(veh_id), δεν αφήνουμε τον χρήστη να διαχειριστεί τα κλειδιά ΠΟΤΕ.
	$queryGetLastID ="SELECT MAX(veh_id) FROM vehicle";
	$rsGetLastID = pg_query($con, $queryGetLastID) or die("Cannot execute queryGetLastID: $queryGetLastID\n");
	$veh_idTemp = pg_fetch_row($rsGetLastID); 
	
	// Νέο ID(veh_id) +1 του τελευταίου(μεγαλύτερου).
	$veh_idTemp[0]++;
	
	// Παίρνουμε τις τιμές της φόρμας.
	$st_caseTemp = pg_escape_string($_POST['st_case']);
	$numoccsTemp = pg_escape_string($_POST['numoccs']);
	$hit_runTemp = pg_escape_string($_POST['hit_run']);
	$reg_statTemp = pg_escape_string($_POST['reg_stat']);
	$ownerTemp = pg_escape_string($_POST['owner']);
	$makeTemp = pg_escape_string($_POST['make']);
	$mod_yearTemp = pg_escape_string($_POST['mod_year']);
	$haz_invTemp = pg_escape_string($_POST['haz_inv']);
	$trav_spTemp = pg_escape_string($_POST['trav_sp']);
	$deformedTemp = pg_escape_string($_POST['deformed']);
	$speedrelTemp = pg_escape_string($_POST['speedrel']);	
	$deathsTemp = pg_escape_string($_POST['deaths']);
	$dr_drinkTemp = pg_escape_string($_POST['dr_drink']);
	
	// Εντολή για την εισαγωγή στην βάση(ΠΙΝΑΚΑ vehicle).
	$queryInsertVehicle = "INSERT INTO vehicle(veh_id,numoccs,hit_run,reg_stat,owner,make,mod_year,haz_inv,trav_sp,deformed,speedrel,deaths,dr_drink) VALUES ('$veh_idTemp[0]','$numoccsTemp','$hit_runTemp','$reg_statTemp','$ownerTemp','$makeTemp','$mod_yearTemp','$haz_invTemp','$trav_spTemp','$deformedTemp','$speedrelTemp','$deathsTemp','$dr_drinkTemp')"; 
	$rs0 = pg_query($con, $queryInsertVehicle) or die("Cannot execute queryInsertVehicle: $queryInsertVehicle\n");
	echo"Επιτυχής Εισαγωγή Δεδομένων Στην Βάση(ΠΙΝΑΚΑ vehicle)!!!<br> 
		Η νέα εγγραφή(record) έχει κωδικό(veh_id): <b>".$veh_idTemp[0]."</b>
		<br> <br> ";
	
	// Εντολή για την εισαγωγή στην βάση (ΣΧΕΣΗ involve).	
	$queryInsertInvolve = "INSERT INTO involve(veh_id,st_case) VALUES ('$veh_idTemp[0]','$st_caseTemp')"; 
	$rs1 = pg_query($con, $queryInsertInvolve) or die("Cannot execute queryInsertInvolve: $queryInsertInvolve\n");
	echo"Επιτυχής Εισαγωγή Δεδομένων Στην Βάση(ΣΧΕΣΗ involve)!!!<br> 
		";
		
	pg_close($con);
}
?>

</body>
</html>