<html>
<head>
	<form><input type="button" value=" Εισαγωγή " onClick="window.location.href='/~db1u36/Insert/insertIndex.php'"></form> 
	<title> Εισαγωγή 3.1α </title>
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


<h2> Εισαγωγή 3.1α </h2>
<p>Εισαγωγή στοιχείων Ατυχήματος:</p>

<form align="left" action="insert3_1a.php" method="post">
	<table align="left">
		
		<tr> <td>State:</td> <td><input type="number" name="state"></td> </tr>
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

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


	
<?php
if(isset($_POST['Submit'])){ 
		
	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")or die("Could not connect to server\n");// open the connection
	
	// Παίρνω το μεγαλύτερο ID(st_case), δεν αφήνουμε τον χρήστη να διαχειριστεί τα κλειδιά ΠΟΤΕ.
	$queryGetLastID ="SELECT MAX(st_case) FROM accident";
	$rsGetLastID = pg_query($con, $queryGetLastID) or die("Cannot execute queryGetLastID: $queryGetLastID\n");
	$st_caseTemp = pg_fetch_row($rsGetLastID); 
	
	// Νέο ID(st_case) +1 του τελευταίου(μεγαλύτερου).
	$st_caseTemp[0]++;
	
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
	
	// Εντολή για την εισαγωγή στην βάση (ΠΙΝΑΚΑ accident).
	$queryInsertAccident = "INSERT INTO accident(st_case,state,ve_forms,pvh_invl,pernotmvit,permvit,day,month,year,day_week,hour,minute,road_fnc,lgt_cond,weather,not_hour,not_min,arr_hour,arr_min,hosp_hr,hosp_min) VALUES 	('$st_caseTemp[0]','$stateTemp','$ve_formsTemp','$pvh_invlTemp','$pernotmvitTemp','$permvitTemp','$dayTemp','$monthTemp','$yearTemp','$hourTemp','$minuteTemp','$road_fncTemp','$day_weekTemp','$weatherTemp','$lgt_condTemp','$not_hourTemp','$not_minTemp','$arr_hourTemp','$arr_minTemp','$hosp_hrTemp','$hosp_minTemp')"; 
	$rs0 = pg_query($con, $queryInsertAccident) or die("Cannot execute queryInsertAccident 3.1.1: $queryInsertAccident\n");
		
	echo"Επιτυχής Εισαγωγή Δεδομένων Στην Βάση(ΠΙΝΑΚΑ accident)!!!<br> 
		Η νέα εγγραφή(record) έχει κωδικό(st_case): <b>".$st_caseTemp[0]."</b>
		";
		
	pg_close($con);
}
?>

</body>
</html>