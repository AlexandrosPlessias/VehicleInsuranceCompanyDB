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
pg_close($con); 
?>


<h2> Διαγραφή 3.1α </h2>
<p>Διαγραφή στοιχείων Ατυχήματος:</p>

<form align="left" action="delete3_1a.php" method="post">
	<table align="left">
		
		<tr> <td>State:</td> <td><input type="number" name="state" required></td> </tr>
		<tr> <td>Moving vehicles:</td> <td><input type="number" name="ve_forms" required></td> </tr>
		<tr> <td>Non moving vehicles:</td> <td><input type="number" name="pvh_invl" required></td> </tr>
		<tr> <td>Non board persons:</td> <td><input type="number" name="pernotmvit" required></td> </tr>
		<tr> <td>Board persons:</td> <td><input type="number" name="permvit" required></td> </tr>
		<tr> <td>Day:</td> <td><input type="number" name="day" required></td> </tr>
		<tr> <td>Month:</td> <td><input type="number" name="month" required></td> </tr>
		<tr> <td>Year:</td> <td><input type="number" name="year" required></td> </tr>
		<tr> <td>Day of the week:</td> <td><input type="number" name="day_week" required></td> </tr>
		<tr> <td>Hour:</td> <td><input type="number" name="hour" required></td> </tr>
		<tr> <td>Minute:</td> <td><input type="number" name="minute" required></td> </tr>
		<tr> <td>Point of the accident:</td> <td><input type="number" name="road_fnc" required></td> </tr>
		<tr> <td>Light level:</td> <td><input type="number" name="lgt_cond" required></td> </tr>
		<tr> <td>Weather:</td> <td><input type="number" name="weather" required></td> </tr>
		<tr> <td>Hour for first aid:</td> <td><input type="number" name="not_hour" required></td> </tr>
		<tr> <td>Minutes for first aid:</td> <td><input type="number" name="not_min" required></td> </tr>
		<tr> <td>First aid hour arrival:</td> <td><input type="number" name="arr_hour" required></td> </tr>
		<tr> <td>First aid minutes arrival:</td> <td><input type="number" name="arr_min" required></td> </tr>
		<tr> <td>Hour arrival of victims to hospitals:</td> <td><input type="number" name="hosp_hr" required></td> </tr>
		<tr> <td>Minutes arrival of victims to hospitals:</td> <td><input type="number" name="hosp_min" required></td></tr>
		<tr><td> </td><td><input type="Submit" name="Submit" value="Submit"></td></tr>
		
	</table>	
</form>	

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


	
<?php
if(isset($_POST['Submit'])){ 
		
	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")or die("Could not connect to server\n");// open the connection
	
	// Παίρνουμε τις τιμές της φόρμας.
	$stateTemp = pg_escape_string($_POST['state']);
	$ve_formsTemp = pg_escape_string($_POST['ve_forms']);
	$pvh_invlTemp = pg_escape_string($_POST['pvh_invl']);
	$pernotmvitTemp = pg_escape_string($_POST['pernotmvit']);
	$permvitTemp = pg_escape_string($_POST['permvit']);
	$dayTemp = pg_escape_string($_POST['day']);
	$monthTemp = pg_escape_string($_POST['month']);
	$yearTemp = pg_escape_string($_POST['year']);
	$hourTemp = pg_escape_string($_POST['hour']);
	$minuteTemp = pg_escape_string($_POST['minute']);
	$road_fncTemp = pg_escape_string($_POST['road_fnc']);	
	$day_weekTemp = pg_escape_string($_POST['day_week']);
	$weatherTemp = pg_escape_string($_POST['weather']);
	$lgt_condTemp = pg_escape_string($_POST['lgt_cond']);
	$not_hourTemp = pg_escape_string($_POST['not_hour']);
	$not_minTemp = pg_escape_string($_POST['not_min']);
	$arr_hourTemp = pg_escape_string($_POST['arr_hour']);
	$arr_minTemp = pg_escape_string($_POST['arr_min']);
	$hosp_hrTemp = pg_escape_string($_POST['hosp_hr']);
	$hosp_minTemp = pg_escape_string($_POST['hosp_min']);
	
	// Έλεγχος για το εαν υπάρχει η εγγραφή που θέλει να διαγράψει ο χρήστης.
	$queryIfExist= "SELECT st_case FROM accident WHERE '$stateTemp' = state AND '$ve_formsTemp' = ve_forms AND '$pvh_invlTemp' = pvh_invl AND '$pernotmvitTemp' = pernotmvit AND '$permvitTemp' = permvit AND '$dayTemp' = day AND '$monthTemp' = month AND '$yearTemp' = year AND '$hourTemp' = hour AND '$minuteTemp' = minute AND '$road_fncTemp' = road_fnc AND '$day_weekTemp' = day_week AND '$weatherTemp' = weather AND '$lgt_condTemp' = lgt_cond AND '$not_hourTemp' = not_hour AND '$not_minTemp' = not_min AND '$arr_hourTemp' = arr_hour AND '$arr_minTemp' = arr_min AND '$hosp_hrTemp' = hosp_hr AND '$hosp_minTemp' = hosp_min ";
	$rs0=pg_query($con, $queryIfExist) or die("Cannot execute queryIfExist: $queryIfExist\n");
	
	
	// Χρήση σειρών αποτελέσματος 
	$numOfRows = pg_numrows($rs0);
	
	// Εαν οι σειρές είναι == 1 τότε υπάρχει η εγγραφή που θέλει να διαγράψει ο χρήστης.
	if($numOfRows==1){
		// Εντολή για την Διαγραφή από την βάση(ΠΙΝΑΚΑ accident).
		$queryDeleteAccident = "DELETE FROM accident WHERE '$stateTemp' = state AND '$ve_formsTemp' = ve_forms AND '$pvh_invlTemp' = pvh_invl AND '$pernotmvitTemp' = pernotmvit AND '$permvitTemp' = permvit AND '$dayTemp' = day AND '$monthTemp' = month AND '$yearTemp' = year AND '$hourTemp' = hour AND '$minuteTemp' = minute AND '$road_fncTemp' = road_fnc AND '$day_weekTemp' = day_week AND '$weatherTemp' = weather AND '$lgt_condTemp' = lgt_cond AND '$not_hourTemp' = not_hour AND '$not_minTemp' = not_min AND '$arr_hourTemp' = arr_hour AND '$arr_minTemp' = arr_min AND '$hosp_hrTemp' = hosp_hr AND '$hosp_minTemp' = hosp_min ";;  
		$rs1 = pg_query($con, $queryDeleteAccident) or die("Cannot execute queryDeleteAccident: $queryDeleteAccident\n");
		echo"Υπάρχει μόνο μια εγγραφή(record) με αυτά τα στοιχεία.!<br> 
			Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ accident)!!
			";
	// Δεν υπάρχει
	}else if($numOfRows==0){
		echo"<b>Ανεπιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ accident)</b>.<br>
			Δεν υπάρχει η εγγραφή(record) που θέλετε να διαγράψετε.<br>
			";
	// Παραπάνω απο μία με διαφορερικό κλειδί.
	}else{
		// Εμφάνιση των εγγραφών.
		echo"<h3>Υπάρχουν παραπάνω από μια εγγραφές με τα στοιχεία που έχετε δώσει!!! </h3>
			<table border=\"1\" width=\"100\" >
				<tr> <td align=\"center\"><b>ST_CASE</b></td> </tr>";	
				
		while ($r0 = pg_fetch_object($rs0)) {	
			echo"<tr>
					<td align=\"center\">". $r0->st_case ."</td>
				</tr>
				";	
		}
		
		echo"</table>
			";
		
		// Εμφάνηση φόρμας για επιλογη ST_CASE προς διαγραφή
		echo"<h3>Παρακαλώ συμπληρώστε τον κωδικό που θέλετε να διαγράψετε. </h3>
			<form align=\"left\" action=\"delete3_1aExtend.php\" method=\"post\">
			<table align=\"left\">
				<tr> <td>St_case:</td> <td><input type=\"number\" name=\"st_case\" required></td></tr>
				<tr><td> </td><td><input type=\"Submit\" name=\"SubmitStcase\" value=\"Submit\"></td></tr>
			</table>	
			</form>
			";
	}	
}

pg_close($con);
?>
		


</body>
</html>