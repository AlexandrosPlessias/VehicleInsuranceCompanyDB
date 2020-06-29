<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title>Ερώτηση 4.4.19</title>
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

echo"<h2> Ερώτηση 4.4.19 </h2>
	<p>Για κάθε κατασκευαστή εταιρίας οχημάτων υπολογίστε για τους οδηγούς που επιβίωσαν το ποσοστό εκείνων που χρησιμοποιούσε κάποιο προστατευτικό εξοπλισμό.</p>
    <table border=\"1\" width=\"700\" >
	<tr> <td align=\"center\"><b>MANUFACTURER</b></td> <td align=\"center\"><b>SURVIVED</b></td> <td align=\"center\"><b>SURVIVED WITH EQUIP</b></td> <td align=\"center\"><b>PERCENT </b></td> </tr>";



$allAliveDriversPerMake;
$allAliveDriversPerMakeWithEquip;
$percent;

// All car manufacturer.
$queryGetMake = "SELECT * FROM make ORDER BY description";
$rsGetMake = pg_query($con, $queryGetMake) or die("Cannot execute queryGetMake: $queryGetMake\n");

// For each manufacturer.
while ($ro = pg_fetch_object($rsGetMake)) {
	// Clear temp values.
	$allAliveDriversPerMake=0;
	$allAliveDriversPerMakeWithEquip=0;
	$percent=0;
	
	$queryGetAliveDriversPerMake ="SELECT SUM(case when person.per_typ=1 AND (person.doa=0) AND vehicle.make='$ro->code' then 1 else 0 end) FROM person,vehicle,board WHERE board.per_id=person.per_id AND board.veh_id=vehicle.veh_id";
	$rsGetAliveDriversPerMake = pg_query($con, $queryGetAliveDriversPerMake) or die("Cannot execute queryGetAliveDriversPerMake: $queryGetAliveDriversPerMake\n");
	$rowGetAliveDriversPerMake= pg_fetch_row($rsGetAliveDriversPerMake);
	$allAliveDriversPerMake=$rowGetAliveDriversPerMake[0];
	
	$queryGetAliveDriversPerMakeWithEquip ="SELECT SUM(case when person.per_typ=1 AND (person.doa=0) AND vehicle.make='$ro->code' AND (person.rest_use!=0 AND person.rest_use!=98 AND person.rest_use!=99 AND person.rest_use!=17 AND person.rest_use!=7) then 1 else 0 end) FROM person,vehicle,board WHERE board.per_id=person.per_id AND board.veh_id=vehicle.veh_id";
	$rsGetAliveDriversPerMakeWithEquip = pg_query($con, $queryGetAliveDriversPerMakeWithEquip) or die("Cannot execute queryGetAliveDriversPerMakeWithEquip: $queryGetAliveDriversPerMakeWithEquip\n");
	$rowGetAliveDriversPerMakeWithEquip = pg_fetch_row($rsGetAliveDriversPerMakeWithEquip);
	$allAliveDriversPerMakeWithEquip=$rowGetAliveDriversPerMakeWithEquip[0];
	
	if($allAliveDriversPerMake!=0){
		// Calc percent.
		$div= (float)($allAliveDriversPerMakeWithEquip / $allAliveDriversPerMake ) * 100;
		$divRound = sprintf('%0.2f', $div);
		$percent= pg_escape_string($divRound);
		
		echo"<tr>
				<td align=\"center\">". $ro->description."</td>
				<td align=\"center\">". $allAliveDriversPerMake."</td>
				<td align=\"center\">". $allAliveDriversPerMakeWithEquip."</td>
				<td align=\"center\">". $percent."</td>
			</tr>
			";	
	}else{
		echo"<tr>
				<td align=\"center\">". $ro->description."</td>
				<td align=\"center\">". $allAliveDriversPerMake."</td>
				<td align=\"center\">". $allAliveDriversPerMakeWithEquip."</td>
				<td align=\"center\"> CAN NOT DEFINED </td>
			</tr>
			";
	}	
}

	
echo"
	</table></br></br>
	";

	
pg_close($con); 
?>

</body>
</html>
