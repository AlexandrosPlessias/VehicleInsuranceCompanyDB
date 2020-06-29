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
pg_close($con); 
?>


<h2> Διαγραφή 3.1β </h2>
<p>Διαγραφή στοιχείων Οχημάτων:</p>

<form align="left" action="delete3_1b.php" method="post">
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
	
	// Έλεγχος για το εαν υπάρχει η εγγραφή που θέλει να διαγράψει ο χρήστης.
	$queryIfExist= "SELECT veh_id FROM vehicle WHERE '$numoccsTemp' =  numoccs AND '$hit_runTemp' =  hit_run AND '$reg_statTemp' =  reg_stat AND '$ownerTemp' =  owner AND '$makeTemp' =  make AND '$mod_yearTemp' =  mod_year AND '$haz_invTemp' =  haz_inv AND '$trav_spTemp' =  trav_sp AND '$deformedTemp' =  deformed AND '$speedrelTemp' =  speedrel AND '$deathsTemp' =  deaths AND '$dr_drinkTemp' =  dr_drink "; 
	$rs0=pg_query($con, $queryIfExist) or die("Cannot execute queryIfExist: $queryIfExist\n");
	
	// Χρήση σειρών αποτελέσματος 
	$numOfRows = pg_numrows($rs0);
	
	// Εαν οι σειρές είναι == 1 τότε υπάρχει η εγγραφή που θέλει να διαγράψει ο χρήστης.
	if($numOfRows==1){
		// Εντολή για την Διαγραφή από την βάση(ΠΙΝΑΚΑ vehicle).
		$queryDeleteVehicle = "DELETE FROM vehicle WHERE '$numoccsTemp' =  numoccs AND '$hit_runTemp' =  hit_run AND '$reg_statTemp' =  reg_stat AND '$ownerTemp' =  owner AND '$makeTemp' =  make AND '$mod_yearTemp' =  mod_year AND '$haz_invTemp' =  haz_inv AND '$trav_spTemp' =  trav_sp AND '$deformedTemp' =  deformed AND '$speedrelTemp' =  speedrel AND '$deathsTemp' =  deaths AND '$dr_drinkTemp' =  dr_drink "; 
		$rs1 = pg_query($con, $queryDeleteVehicle) or die("Cannot execute queryDeleteVehicle: $queryDeleteVehicle\n");
		echo"Υπάρχει μόνο μια εγγραφή(record) με αυτά τα στοιχεία.!<br> 
			Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ vehicle)!!<br>
			";
			
		$r0 = pg_fetch_object($rs0);
		// Εντολή για την Διαγραφή από την βάση(ΣΧΕΣΗ involve).	
		$queryDeleteΙnvolve = "DELETE FROM involve WHERE '$st_caseTemp' = st_case AND '$r0->veh_id'=veh_id "; 
		$rs1 = pg_query($con, $queryDeleteΙnvolve) or die("Cannot execute queryDeleteΙnvolve: $queryDeleteΙnvolve\n");
		echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΣΧΕΣΗ involve)!!
			";
		
	// Δεν υπάρχει
	}else if($numOfRows==0){
		echo"<b>Ανεπιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ vehicle)</b>.<br>
			Δεν υπάρχει η εγγραφή(record) που θέλετε να διαγράψετε.<br>
			";
	// Παραπάνω απο μία με διαφορερικό κλειδί.
	}else{
		// Εμφάνιση των εγγραφών.
		echo"<h3>Υπάρχουν παραπάνω από μια εγγραφές με τα στοιχεία που έχετε δώσει!!! </h3>
			<table border=\"1\" width=\"100\" >
				<tr> <td align=\"center\"><b>VEH_ID</b></td> <td align=\"center\"><b>ACCIDENT ID</b></td> </tr>";	
				
		while ($r0 = pg_fetch_object($rs0)) {	
			echo"<tr>
					<td align=\"center\">". $r0->veh_id ."</td>
					<td align=\"center\">". $st_caseTemp ."</td>
				</tr>
				";	
		}
		
		echo"</table>
			";
		
		// Εμφάνηση φόρμας για επιλογη VEH_ID,ST_CASE προς διαγραφή
		echo"<h3>Παρακαλώ συμπληρώστε τους κωδικούς. </h3>
			<form align=\"left\" action=\"delete3_1bExtend.php\" method=\"post\">
			<table align=\"left\">
				<tr> <td>Veh_id:</td> <td><input type=\"number\" name=\"veh_id\" required></td></tr>
				<tr> <td>Accident id:</td> <td><input type=\"number\" name=\"st_case\" required></td></tr>
				<tr><td> </td><td><input type=\"Submit\" name=\"SubmitStcase\" value=\"Submit\"></td></tr>
			</table>	
			</form>
			";
	}

		
	pg_close($con);
}
?>

</body>
</html>