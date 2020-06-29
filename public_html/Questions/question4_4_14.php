<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title>Ερώτηση 4.4.14</title>
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

<h2> Ερώτηση 4.4.14 </h2>
<p>Βρείτε τον συνολικό αριθμό κινούμενων και ακίνητων οχημάτων που ενεπλάκησαν,καθώς και τον συνολικό αριθμό εποχούμενων και μη-εποχούμενων για τα ατυχήματα που έγιναν στην πολιτεία Π..</p>

<form align="left" action="question4_4_14.php" method="post">
	<table align="left">
		<tr>
			<td>State:</td> <td><input type="text" name="state" required></td>  <td><input type="Submit" name="Submit" value="Submit"></td>
		</tr>
	</table>
	
</form>		
<br><br><br>

<?php
if(isset($_POST['Submit'])){ 

	$stateTemp= pg_escape_string($_POST['state']);	
	echo "<p>Statistics for <b>".$stateTemp."</b>: </p>";
	echo"<table border=\"1\" width=\"500\" >
		<tr> 
			<td align=\"center\"><b>MOVING VEHICLES</b></td> <td align=\"center\"><b>STOPPED VEHICLES</b></td> <td align=\"center\"><b>BOARD PERSONS</b></td> <td align=\"center\"><b>NONBOARD PERSONS</b></td> 
		</tr>
		";

	$con = pg_connect("host=$host dbname=$db user=$user password=$pass")or die("Could not connect to server\n");
	
	$query0 = "SELECT code FROM state WHERE Description='$stateTemp'"; 
	$rs0 = pg_query($con, $query0) or die("Cannot execute query 4.4.14a: $query\n");
	$rowQ0 = pg_fetch_row($rs0); 
	$state = $rowQ0[0];
	
	$query1 = "SELECT SUM(ve_forms) FROM accident WHERE state='$state'"; 
	$rs1 = pg_query($con, $query1) or die("Cannot execute query 4.4.14a: $query\n");
	$rowQ1 = pg_fetch_row($rs1); 
	$allMovingVeh = $rowQ1[0];

	$query2 = "SELECT SUM(pvh_invl) FROM accident WHERE state='$state'";  
	$rs2 = pg_query($con, $query2) or die("Cannot execute query 4.4.14b: $query\n");
	$rowQ2 = pg_fetch_row($rs2); 
	$allStoppedVeh = $rowQ2[0];

	$query3 = "SELECT SUM(pernotmvit) FROM accident WHERE state='$state'";  
	$rs3 = pg_query($con, $query3) or die("Cannot execute query 4.4.14c: $query\n");
	$rowQ3 = pg_fetch_row($rs3); 
	$allNonBoardPer = $rowQ3[0];

	$query4 = "SELECT SUM(permvit) FROM accident WHERE state='$state'";  
	$rs4 = pg_query($con, $query4) or die("Cannot execute query 4.4.14d: $query\n");
	$rowQ4 = pg_fetch_row($rs4); 
	$allBoardPer = $rowQ4[0];	

	echo"
		<tr>
			<td align=\"center\">". $allMovingVeh ."</td>
			<td align=\"center\">". $allStoppedVeh ."</td>
			<td align=\"center\">". $allBoardPer ."</td>
			<td align=\"center\">". $allNonBoardPer ."</td>
		</tr>";	

	echo"
		</table></br></br>";
		
	pg_close($con); 
}
?>

</body>
</html>
