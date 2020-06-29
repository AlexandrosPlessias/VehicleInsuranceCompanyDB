<html>
<head>
	<form><input type="button" value=" Εισαγωγή " onClick="window.location.href='/~db1u36/Insert/insertIndex.php'"></form> 
	<title> Εισαγωγή 3.1ζ </title>
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


<h2> Εισαγωγή 3.1ζ </h2>
<p>Εισαγωγή στοιχείων αντικειμένων οπτικού πεδίου:</p>

<form align="left" action="insert3_1g.php" method="post">
	<table align="left">
							
		<tr><td>Vehicle id:</td> <td><input type="number" name="veh_id" required></td></tr>			
		<tr><td>Objects prevented the driver's vision:</td> <td><input type="number" name="mvisobsc" required></td></tr>							
		<tr><td> </td><td><input type="Submit" name="Submit" value="Submit"></td></tr>
		
	</table>	
</form>	

<br><br><br><br><br>
	
<?php
if(isset($_POST['Submit'])){ 
		
	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")or die("Could not connect to server\n");

	// Παίρνουμε τις τιμές της φόρμας.
	$veh_idTemp = pg_escape_string($_POST['veh_id']);
	$mvisobscTemp = pg_escape_string($_POST['mvisobsc']);

	// Έλεγχος για διπλότυπο(duplicate).
	$queryIfExist="SELECT * FROM vision WHERE veh_id='$veh_idTemp' AND mvisobsc='$mvisobscTemp'";
	$rs0=pg_query($con, $queryIfExist) or die("Cannot execute queryIfExist: $queryIfExist\n");
	
	// Χρήση σειρών αποτελέσματος 
	$numOfRows = pg_numrows($rs0);
	
	// Εαν οι σειρές είναι ==0 τότε δεν υπάρχει διπλότυπο(duplicate).
	if($numOfRows==0){
		// Εντολή για την εισαγωγή στην βάση(ΠΙΝΑΚΑ vision).
		$queryInsertVision = "INSERT INTO vision(veh_id,mvisobsc) VALUES ('$veh_idTemp','$mvisobscTemp')";  
		$rs1 = pg_query($con, $queryInsertVision) or die("Cannot execute queryInsertVision: $queryInsertVision\n");
		echo"Επιτυχής Εισαγωγή Δεδομένων Στην Βάση(ΠΙΝΑΚΑ vision)!!!<br> 
			";
	}else{
		echo"<b>Ανεπιτυχής Εισαγωγή Δεδομένων Στην Βάση(ΠΙΝΑΚΑ vision)</b>.<br>
			Υπάρχει ήδη η εγγραφή(record) που θέλετε να εισάγετε.<br>
			";
	}
		
	pg_close($con);
}
?>

</body>
</html>