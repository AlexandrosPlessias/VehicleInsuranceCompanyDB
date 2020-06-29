<html>
<head>
	<form><input type="button" value=" Εισαγωγή " onClick="window.location.href='/~db1u36/Insert/insertIndex.php'"></form> 
	<title> Εισαγωγή 3.1γ </title>
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


<h2> Εισαγωγή 3.1γ </h2>
<p>Εισαγωγή στοιχείων Ατόμων:</p>

<form align="left" action="insert3_1c.php" method="post">
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
	
	// Παίρνω το μεγαλύτερο ID(per_id), δεν αφήνουμε τον χρήστη να διαχειριστεί τα κλειδιά ΠΟΤΕ.
	$queryGetLastID ="SELECT MAX(per_id) FROM person";
	$rsGetLastID = pg_query($con, $queryGetLastID) or die("Cannot execute queryGetLastID: $queryGetLastID\n");
	$per_idTemp = pg_fetch_row($rsGetLastID); 
	
	// Νέο ID(per_id) +1 του τελευταίου(μεγαλύτερου).
	$per_idTemp[0]++;
	
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
	

	// Εντολή για την εισαγωγή στην βάση(ΠΙΝΑΚΑ person).
	$queryInsertPerson = "INSERT INTO person(per_id,veh_no,age,sex,per_typ,inj_sev,seat_pos,rest_use,air_bag,ejection,doa,death_da,death_mo,death_yr) VALUES ('$per_idTemp[0]','$veh_noTemp','$ageTemp','$sexTemp','$per_typTemp','$inj_sevTemp','$seat_posTemp','$rest_useTemp','$air_bagTemp','$ejectionTemp','$doaTemp','$death_daTemp','$death_moTemp','$death_yrTemp')"; 
	$rs0 = pg_query($con, $queryInsertPerson) or die("Cannot execute queryInsertPerson: $queryInsertPerson\n");
	echo"Επιτυχής Εισαγωγή Δεδομένων Στην Βάση(ΠΙΝΑΚΑ person)!!!<br> 
		Η νέα εγγραφή(record) έχει κωδικό(veh_id): <b>".$per_idTemp[0]."</b>
		<br> <br> ";
	
	// Εντολή για την εισαγωγή στην βάση (ΣΧΕΣΗ board).	
	if($veh_noTemp==1){
		$queryInsertBoard = "INSERT INTO board(per_id,veh_id) VALUES ('$per_idTemp[0]','$veh_idTemp')"; 
		$rs1 = pg_query($con, $queryInsertBoard) or die("Cannot execute queryInsertBoard: $queryInsertBoard\n");
		echo"Επιτυχής Εισαγωγή Δεδομένων Στην Βάση(ΣΧΕΣΗ board)!!!<br> 
			<br> <br> ";
	}else{
		// Εντολή για την εισαγωγή στην βάση (ΣΧΕΣΗ non_board).	
		$queryInsertNonBoard = "INSERT INTO non_board(per_id,st_case) VALUES ('$per_idTemp[0]','$st_caseTemp')"; 
		$rs2 = pg_query($con, $queryInsertNonBoard) or die("Cannot execute queryInsertNonBoard: $queryInsertNonBoard\n");
		echo"Επιτυχής Εισαγωγή Δεδομένων Στην Βάση(ΣΧΕΣΗ non_board)!!!<br> 
			";
	}	
	
		
	pg_close($con);
}
?>

</body>
</html>