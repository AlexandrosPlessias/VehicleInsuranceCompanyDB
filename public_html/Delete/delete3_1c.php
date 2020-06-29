<html>
<head>
	<form><input type="button" value=" Διαγραφή " onClick="window.location.href='/~db1u36/Delete/deleteIndex.php'"></form> 
	<title> Διαγραφή 3.1γ </title>
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


<h2> Διαγραφή 3.1γ </h2>
<p>Διαγραφή στοιχείων Ατόμων:</p>

<form align="left" action="delete3_1c.php" method="post">
	<table align="left">
							
		<tr><td>Accident id:</td> <td><input type="number" name="st_case"></td></tr>			
		<tr><td>Vehicle id:</td> <td><input type="number" name="veh_id" required></td></tr>			
		<tr><td>Board or not board:</td> <td><input type="number" name="veh_no" required></td></tr>			
		<tr><td>Age:</td> <td><input type="number" name="age" required></td></tr>			
		<tr><td>Sex:</td> <td><input type="number" name="sex" required></td></tr>			
		<tr><td>Involve category:</td> <td><input type="number" name="per_typ" required></td></tr>			
		<tr><td>Degree of injury:</td> <td><input type="number" name="inj_sev" required></td></tr>				
		<tr><td>Seat position:</td> <td><input type="number" name="seat_pos" required></td></tr>				
		<tr><td>Protection equipment:</td> <td><input type="number" name="rest_use" required></td></tr>			
		<tr><td>Air bag:</td> <td><input type="number" name="air_bag" required></td></tr>		
		<tr><td>Ejection:</td> <td><input type="number" name="ejection" required></td></tr>		
		<tr><td>Death place:</td> <td><input type="number" name="doa" required></td></tr>		
		<tr><td>Day of death:</td> <td><input type="number" name="death_da" required></td></tr>		
		<tr><td>Day of month:</td> <td><input type="number" name="death_mo" required></td></tr>				
		<tr><td>Day of year:</td> <td><input type="number" name="death_yr" required></td></tr>	
		<tr><td> </td><td><input type="Submit" name="Submit" value="Submit"></td></tr>
		
	</table>	
</form>	

<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br>
	
<?php
if(isset($_POST['Submit'])){ 
		
	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")or die("Could not connect to server\n");
	
	// Παίρνουμε τις τιμές της φόρμας.
	$st_caseTemp = pg_escape_string($_POST['st_case']);
	$veh_idTemp = pg_escape_string($_POST['veh_id']);
	$veh_noTemp = pg_escape_string($_POST['veh_no']);
	$ageTemp = pg_escape_string($_POST['age']);
	$sexTemp = pg_escape_string($_POST['sex']);
	$per_typTemp = pg_escape_string($_POST['per_typ']);
	$inj_sevTemp = pg_escape_string($_POST['inj_sev']);
	$seat_posTemp = pg_escape_string($_POST['seat_pos']);
	$rest_useTemp = pg_escape_string($_POST['rest_use']);
	$air_bagTemp = pg_escape_string($_POST['air_bag']);
	$ejectionTemp = pg_escape_string($_POST['ejection']);	
	$doaTemp = pg_escape_string($_POST['doa']);
	$death_daTemp = pg_escape_string($_POST['death_da']);
	$death_moTemp = pg_escape_string($_POST['death_mo']);
	$death_yrTemp = pg_escape_string($_POST['death_yr']);
	
	// Έλεγχος για το εαν υπάρχει η εγγραφή που θέλει να διαγράψει ο χρήστης.
	$queryIfExist= "SELECT per_id FROM person WHERE '$veh_noTemp' = veh_no AND '$ageTemp' = age AND '$sexTemp' = sex AND '$per_typTemp' = per_typ AND '$inj_sevTemp' = inj_sev AND '$seat_posTemp' = seat_pos AND '$rest_useTemp' = rest_use AND '$air_bagTemp' = air_bag AND '$ejectionTemp' = ejection AND 	'$doaTemp' = doa AND '$death_daTemp' = death_da AND '$death_moTemp' = death_mo AND '$death_yrTemp' = death_yr ";
	$rs0=pg_query($con, $queryIfExist) or die("Cannot execute queryIfExist: $queryIfExist\n");
	
	// Χρήση σειρών αποτελέσματος 
	$numOfRows = pg_numrows($rs0);
	
	// Εαν οι σειρές είναι == 1 τότε υπάρχει η εγγραφή που θέλει να διαγράψει ο χρήστης.
	if($numOfRows==1){
		// Εντολή για την Διαγραφή από την βάση(ΠΙΝΑΚΑ person).
		$queryDeletePerson = "DELETE FROM person WHERE '$veh_noTemp' = veh_no AND '$ageTemp' = age AND '$sexTemp' = sex AND '$per_typTemp' = per_typ AND '$inj_sevTemp' = inj_sev AND '$seat_posTemp' = seat_pos AND '$rest_useTemp' = rest_use AND '$air_bagTemp' = air_bag AND '$ejectionTemp' = ejection AND 	'$doaTemp' = doa AND '$death_daTemp' = death_da AND '$death_moTemp' = death_mo AND '$death_yrTemp' = death_yr "; 
		$rs1 = pg_query($con, $queryDeletePerson) or die("Cannot execute queryDeletePerson: $queryDeletePerson\n");
		echo"Υπάρχει μόνο μια εγγραφή(record) με αυτά τα στοιχεία.!<br> 
			Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ person)!!<br>
			";
			
		$r0 = pg_fetch_object($rs0);
		// Εντολή για την Διαγραφή από την βάση(ΣΧΕΣΗ board).
		if($veh_noTemp==1){
			
			$queryDeleteBoard = "DELETE FROM board WHERE '$r0->per_id' = per_id AND '$veh_idTemp'=veh_id "; 
			$rs1 = pg_query($con, $queryDeleteBoard) or die("Cannot execute queryDeleteBoard: $queryDeleteBoard\n");
			echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΣΧΕΣΗ board)!!
				";
		}else{
		// Εντολή για την Διαγραφή από την βάση(ΣΧΕΣΗ non_board).
			$queryDeleteNonBoard = "DELETE FROM non_board WHERE '$r0->per_id' = per_id AND '$st_caseTemp'=st_case "; 
			$rs1 = pg_query($con, $queryDeleteNonBoard) or die("Cannot execute queryDeleteNonBoard: $queryDeleteNonBoard\n");
			echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΣΧΕΣΗ non_board)!!
				";
		
		}
		
	// Δεν υπάρχει
	}else if($numOfRows==0){
		echo"<b>Ανεπιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ person)</b>.<br>
			Δεν υπάρχει η εγγραφή(record) που θέλετε να διαγράψετε.<br>
			";
	// Παραπάνω απο μία με διαφορερικό κλειδί.
	}else{
		// Εμφάνιση των εγγραφών.
		echo"<h3>Υπάρχουν παραπάνω από μια εγγραφές με τα στοιχεία που έχετε δώσει!!! </h3>
		
		";
		
		
		if($veh_noTemp==1){
			
			echo"<table border=\"1\" width=\"100\" >
				<tr> <td align=\"center\"><b>PERSON ID</b></td> <td align=\"center\"><b>VEHICLE ID</b></td> </tr>";
			while ($r0 = pg_fetch_object($rs0)) {	
				echo"<tr>
						<td align=\"center\">". $r0->per_id ."</td>
						<td align=\"center\">". $veh_idTemp ."</td>
					</tr>
					";
			}
			echo"</table>
				";
			
			// Εμφάνηση φόρμας για επιλογη PER_ID,VEH_ID προς διαγραφή
			echo"<h3>Παρακαλώ συμπληρώστε τους κωδικούς. </h3>
			<form align=\"left\" action=\"delete3_1cExtend.php\" method=\"post\">
			<table align=\"left\">
				<tr> <td>Person id:</td> <td><input type=\"number\" name=\"per_id\" required></td></tr>
				<tr> <td>Vehicle id:</td> <td><input type=\"number\" name=\"veh_id\" required></td></tr>
				<tr><td> </td><td><input type=\"Submit\" name=\"SubmitBoard\" value=\"Submit\"></td></tr>
			</table>	
			</form>
			";
			
		}else{
		
			echo"<table border=\"1\" width=\"100\" >
				<tr> <td align=\"center\"><b>PER_ID</b></td> <td align=\"center\"><b>ACCIDENT ID</b></td> </tr>";
			while ($r0 = pg_fetch_object($rs0)) {	
				echo"<tr>
						<td align=\"center\">". $r0->per_id ."</td>
						<td align=\"center\">". $st_caseTemp ."</td>
					</tr>
					";	
			}
			echo"</table>
				";
			
			// Εμφάνηση φόρμας για επιλογη PER_ID,ST_CASE προς διαγραφή
			echo"<h3>Παρακαλώ συμπληρώστε τους κωδικούς. </h3>
			<form align=\"left\" action=\"delete3_1cExtend.php\" method=\"post\">
			<table align=\"left\">
				<tr> <td>Person id:</td> <td><input type=\"number\" name=\"per_id\" required></td></tr>
				<tr> <td>Accident id:</td> <td><input type=\"number\" name=\"st_case\" required></td></tr>
				<tr><td> </td><td><input type=\"Submit\" name=\"SubmitNonBoard\" value=\"Submit\"></td></tr>
			</table>	
			</form>
			";
			
		}
	}
	
		
	pg_close($con);
}
?>

</body>
</html>