<html>
<head>
	<form><input type="button" value=" Παρουσίαση " onClick="window.location.href='/~db1u36/Presentations/presentationIndex.php'"></form>
	<title>Παρουσίαση 4.3</title>
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
echo"<h2> Παρουσίαση 4.3 </h2>
	<p><b> Παρουσίαση ατυχημάτων και μη-εποχούμενων.</b> Στην λειτουργία αυτή θα παρουσιάσετε τα στοιχεία των ατυχημάτων και των αντίστοιχων μη-εποχούμενων που ενεπλάκησαν σε αυτά με την ακόλουθη μορφή:<br><br>
	&nbsp&nbsp&nbsp&nbspΛεκτικό μήνα 1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΑτύχημα 1.1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΜη-Εποχούμενος 1.1.1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΜη-Εποχούμενος 1.1.2<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp. . .<br>
	
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΑτύχημα 1.κ<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΜη-Εποχούμενος 1.κ.1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp. . .<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp. . . <br>
	
	&nbsp&nbsp&nbsp&nbspΛεκτικό μήνα ν<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΑτύχημα ν.1<br>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspΜη-Εποχούμενος ν.1.1<br>
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
	
	// Εύρεση ατυχήματος για κάθε μήνα με αύξουσα ταξινόμηση(κωδ. ατυχήματος) & εμφάνιση.
	$queryAccidentsOfMonth= "SELECT vehicle.veh_id FROM vehicle,accident,involve WHERE  accident.month='$rowOfMonth[0]' AND involve.st_case=accident.st_case AND involve.veh_id=vehicle.veh_id ORDER BY veh_id";
	$resultAccidentsOfMonth = pg_query($con, $queryAccidentsOfMonth) or die("Cannot execute queryAccidentsOfMonth: $queryAccidentsOfMonth\n");
	$accidentCounter=0;	
	while ($rowAccidentsOfMonth = pg_fetch_row($resultAccidentsOfMonth)) {
		$accidentCounter++;
		echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" .$rowAccidentsOfMonth[0]. " ". $rowOfMonth[0] ."." .$accidentCounter. "<br>";
		
		// Εύρεση μη-εποχούμενων για κάθε ατύχημα με αύξουσα ταξινόμηση(κωδ. εποχούμενου) & εμφάνιση.
		$queryNonBoardOfAccident= "SELECT person.per_id FROM person,accident,non_board WHERE accident.st_case='$rowAccidentsOfMonth[0]' AND non_board.st_case=accident.st_case AND non_board.per_id=person.per_id  ORDER BY per_id";
		$resultNonBoardOfAccident = pg_query($con, $queryNonBoardOfAccident) or die("Cannot execute query queryNonBoardOfAccident: $queryNonBoardOfAccident\n");
		$nonBoardCounter=0;
		while ($rowNonBoardOfAccident = pg_fetch_row($resultNonBoardOfAccident)) {
			$nonBoardCounter++;
			echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp". $rowNonBoardOfAccident[0] ." ". $rowOfMonth[0] .".". $accidentCounter .".". $nonBoardCounter ."<br>";
		}	
	}
}
// Δεν χρησιμοποιείτε μετρητής για τον μήνα τον ρόλο αυτόν τον έχει ο κωδικός του.
	
pg_close($con); 
?>

</body>
</html>