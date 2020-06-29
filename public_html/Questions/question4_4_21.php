<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title>Ερώτηση 4.4.21</title>
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

	echo"<h2> Ερώτηση 4.4.21 </h2>
		<p>Για κάθε μήνα να βρεθούν οι πολιτείες που είχανε μεγαλύτερο αριθμό κινουμένων οχημάτων που ενεπλάκησαν από το μέσο όρο των συνολικών ατυχημάτων σε όλες τις πολιτείες.</p>
		<table border=\"1\" width=\"900\" >
		<tr> <td align=\"center\"><b>MONTH</b></td> <td align=\"center\"><b>AVERAGE VE_FORMS FROM ALL STATES </b></td> <td align=\"center\"><b>STATES GREATER THAN AVERAGE</b></td> </tr>";

	$getAllVeFormsPerMonth;
	$avgOfMonth;
	// All Months.
	$queryGetMonth = "SELECT * FROM month ORDER BY code";
	$rsGetMonth = pg_query($con, $queryGetMonth) or die("Cannot execute queryGetMonth: $queryGetMonth\n");

	// Find number of states.
	$queryStatesNum = "SELECT COUNT(CODE) FROM state";
	$rsStatesNum = pg_query($con, $queryStatesNum) or die("Cannot execute queryStatesNum: $queryStatesNum\n");
	$rowStatesNum= pg_fetch_row($rsStatesNum);
	$statesNum=$rowStatesNum[0];

	// For each month.
	while ($ro = pg_fetch_object($rsGetMonth)) {
		
		$getAllVeFormsPerMonth=0;
		$avgOfMonth=0;


		// Find all VE_FORMS from all states for each month.
		$queryGetAllVeFormsPerMonth ="SELECT SUM(VE_FORMS) FROM accident WHERE MONTH='$ro->code'";
		$rsGetAllVeFormsPerMonth = pg_query($con, $queryGetAllVeFormsPerMonth) or die("Cannot execute queryGetAllVeFormsPerMonth: $queryGetAllVeFormsPerMonth\n");
		$rowGetAllVeFormsPerMonth= pg_fetch_row($rsGetAllVeFormsPerMonth);
		$getAllVeFormsPerMonth=$rowGetAllVeFormsPerMonth[0];
		
		//Calc AVG of month
		$avg= (float)($getAllVeFormsPerMonth / $statesNum );
		$avgRound = sprintf('%0.2f', $avg);
		$avgOfMonth= pg_escape_string($avgRound);
				
		
		echo"<tr>
				<td align=\"center\">". $ro->description. "</td>
				<td align=\"center\">". $avgOfMonth. "</td>
			";
			
			
		$queryGetState = "SELECT * FROM state ORDER BY description";
		$rsGetState = pg_query($con, $queryGetState) or die("Cannot execute queryGetState: $queryGetState\n");
		// For each state.
		echo"<td align=\"center\">";
		while ($ro2 = pg_fetch_object($rsGetState)) {
		
			// Find all VE_FORMS for specific states and month month.
			$queryGetVeFormsOfStatePerMonth ="SELECT SUM(VE_FORMS) FROM accident WHERE MONTH='$ro->code' AND state='$ro2->code'";
			$rsGetVeFormsOfStatePerMonth = pg_query($con, $queryGetVeFormsOfStatePerMonth) or die("Cannot execute queryGetVeFormsOfStatePerMonth: $queryGetVeFormsOfStatePerMonth\n");
			$rowGetVeFormsOfStatePerMonth= pg_fetch_row($rsGetVeFormsOfStatePerMonth);
			$getAllVeFormsPerMonth=$rowGetVeFormsOfStatePerMonth[0];
			
			// Show states biber than AVG.
			if($getAllVeFormsPerMonth>=$avgOfMonth){
				echo"".$ro2->description.", ";
			}
		}
		echo"	</td>
			</tr>
			";
	}

echo"
	</table></br></br>
	";

	
pg_close($con); 
?>

</body>
</html>
