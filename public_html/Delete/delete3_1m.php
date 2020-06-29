<html>
<head>
	<form><input type="button" value=" Διαγραφή " onClick="window.location.href='/~db1u36/Delete/deleteIndex.php'"></form>
	<title> Διαγραφή 3.1ιγ </title>
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


<h2> Διαγραφή 3.1ιγ </h2>
<p>Διαγραφή στοιχείων ενεργειών μη-εποχούμενου λίγο πριν την σύγκρουση:</p>

<form align="left" action="delete3_1m.php" method="post">
	<table align="left">
							
		<tr><td>Person id:</td> <td><input type="number" name="per_id" required></td></tr>			
		<tr><td>Actions made just before the crash:</td> <td><input type="number" name="mpr_act" required></td></tr>							
		<tr><td> </td><td><input type="Submit" name="Submit" value="Submit"></td></tr>
		
	</table>	
</form>	

<br><br><br><br><br>
	
<?php
if(isset($_POST['Submit'])){ 
		
	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")or die("Could not connect to server\n");

	// Παίρνουμε τις τιμές της φόρμας.
	$per_idTemp = pg_escape_string($_POST['per_id']);
	$mpr_actTemp = pg_escape_string($_POST['mpr_act']);

	// Έλεγχος για το εαν υπάρχει η εγγραφή που θέλει να διαγράψει ο χρήστης.
	$queryIfExist="SELECT * FROM non_motorist_prior WHERE per_id='$per_idTemp' AND mpr_act='$mpr_actTemp'";
	$rs0=pg_query($con, $queryIfExist) or die("Cannot execute queryIfExist: $queryIfExist\n");
	
	// Χρήση σειρών αποτελέσματος 
	$numOfRows = pg_numrows($rs0);
	
	// Εαν οι σειρές είναι !=0 τότε υπάρχει η εγγραφή που θέλει να διαγράψει ο χρήστης.
	if($numOfRows!=0){
		// Εντολή για την Διαγραφή από την βάση(ΠΙΝΑΚΑ non_motorist_prior).
		$queryDeleteNonMotorisPrior = "DELETE FROM non_motorist_prior WHERE per_id='$per_idTemp' AND mpr_act='$mpr_actTemp'";  
		$rs1 = pg_query($con, $queryDeleteNonMotorisPrior) or die("Cannot execute queryDeleteNonMotorisPrior: $queryDeleteNonMotorisPrior\n");
		echo"Επιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ non_motorist_prior)!!!<br> 
			";
	}else{
		echo"<b>Ανεπιτυχής Διαγραφή Δεδομένων απο την Βάση(ΠΙΝΑΚΑ non_motorist_prior)</b>.<br>
			Δεν υπάρχει η εγγραφή(record) που θέλετε να διαγράψετε.<br>
			";
	}
		
	pg_close($con);
}
?>

</body>
</html>