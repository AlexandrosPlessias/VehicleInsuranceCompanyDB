<html>
<head>
	<form><input type="button" value=" Παρουσίαση " onClick="window.location.href='/~db1u36/Presentations/presentationIndex.php'"></form>
	<title>Παρουσίαση 4.2</title>
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
$user = "db1u36"; // Εδώ βάλετε την ομάδα σας . 
$pass = "Jy03y9TC"; // Εδώ βάλετε τον κωδικό σας.
$db = $user; 
$con = pg_connect("host=$host dbname=$db user=$user password=$pass")or die("Could not connect to server\n"); 

// Εκφώνηση.
echo"<h2> Παρουσίαση 4.2 </h2>
	<p><b>Παρουσίαση οχημάτων και εποχούμενων.</b> Στην λειτουργία αυτή θα παρουσιάσετε τα στοιχεία των οχημάτων και των αντίστοιχων εποχούμενων  σε αυτά με την ακόλουθη μορφή:<br><br>
	&nbsp&nbsp&nbsp&nbspΛεκτικό μήνα 1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΌχημα 1.1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΕποχούμενος 1.1.1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΕποχούμενος 1.1.2<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp. . .<br>
	
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΌχημα 1.κ<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΕποχούμενος 1.κ.1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp. . .<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp. . . <br>
	
	&nbsp&nbsp&nbsp&nbspΛεκτικό μήνα ν<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΌχημα ν.1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΕποχούμενος ν.1.1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp. . .<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp. . .<br>
	
	&nbsp&nbsp&nbsp&nbsp. . .</p>
	<br>
	
	<p><b>Ακολουθεί η παρουσίαση:</b></p>
	";
	
// Εύρεση κάθε μήνα με αύξουσα ταξινόμηση(κωδ. μήνα) & εμφάνιση.
$queryMonth= "SELECT code,description FROM month ORDER BY code";
$resultMonth = pg_query($con, $queryMonth) or die("Cannot execute queryMonth: $queryMonth\n");
while ($rowOfMonth = pg_fetch_row($resultMonth)) {
	echo"&nbsp&nbsp&nbsp&nbsp" . $rowOfMonth[1] . "<br>";
	
	// Εύρεση οχήματος για κάθε μήνα με αύξουσα ταξινόμηση(κωδ. οχήματος) & εμφάνιση.
	$queryVehiclesOfMonth= "SELECT vehicle.veh_id FROM vehicle,accident,involve WHERE  accident.month='$rowOfMonth[0]' AND involve.st_case=accident.st_case AND involve.veh_id=vehicle.veh_id ORDER BY veh_id";
	$resultVehiclesOfMonth = pg_query($con, $queryVehiclesOfMonth) or die("Cannot execute queryVehiclesOfMonth: $queryVehiclesOfMonth\n");
	$vehicleCounter=0;	
	while ($rowVehiclesOfMonth = pg_fetch_row($resultVehiclesOfMonth)) {
		$vehicleCounter++;
		echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" .$rowVehiclesOfMonth[0]. " ". $rowOfMonth[0] ."." .$vehicleCounter. "<br>";
		
		// Εύρεση εποχούμενων για κάθε όχημα με αύξουσα ταξινόμηση(κωδ. εποχούμενου) & εμφάνιση.
		$queryBoardOfVehicle= "SELECT person.per_id FROM person,vehicle,board WHERE vehicle.veh_id='$rowVehiclesOfMonth[0]' AND person.veh_no=1 AND board.per_id=person.per_id AND board.veh_id=vehicle.veh_id ORDER BY per_id";
		$resultBoardOfVehicle = pg_query($con, $queryBoardOfVehicle) or die("Cannot execute query queryBoardOfVehicle: $queryBoardOfVehicle\n");
		$boardCounter=0;
		while ($rowresultBoardOfVehicle = pg_fetch_row($resultBoardOfVehicle)) {
			$boardCounter++;
			echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp". $rowresultBoardOfVehicle[0] ." ". $rowOfMonth[0] .".". $vehicleCounter .".". $boardCounter ."<br>";
		}	
	}
}
// Δεν χρησιμοποιείτε μετρητής για τον μήνα τον ρόλο αυτόν τον έχει ο κωδικός του.
	
pg_close($con); 
?>

</body>
</html>