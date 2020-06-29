<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title>Ερώτηση 4.4.8</title>
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

$query = "SELECT SUM(case when person.per_typ=1 then 1 else 0 end) AS DRIVERS FROM person";
$rs = pg_query($con, $query) or die("Cannot execute query 4.4.8a: $query\n");
$row = pg_fetch_row($rs); 
$allDrivers = $row[0];



$query2 = "SELECT SUM(case when distract.mdrdstrd=0 then 1 else 0 end) AS CDRIVERS FROM distract";
$rs2 = pg_query($con, $query2) or die("Cannot execute query 4.4.8b: $query\n");
$row2 = pg_fetch_row($rs2); 
$careDrivers = $row2[0];


//calc persent
$div= (float)($careDrivers / $allDrivers ) * 100;
$divRound = sprintf('%0.2f', $div);
$persent= pg_escape_string($divRound);

echo"<h2> Ερώτηση 4.4.8 </h2>
	<p>Βρείτε το ποσοστό των οχημάτων των οποίων η προσοχή των οδηγών τους δεν διασπάστηκε. Αγνοείστε τις τιμές (MDRDSTRD=16,96,99).</p>
    <table border=\"1\" width=\"500\" >
	<tr> <td align=\"center\"><b>ALL DRIVERS</b></td> <td align=\"center\"><b>CAREFULL DRIVERS</b></td> <td align=\"center\"><b>PERCENT(%)</b></td> </tr>";

echo"
	<tr>
		<td align=\"center\">". $allDrivers."</td>
		<td align=\"center\">". $careDrivers."</td>
		<td align=\"center\">". $persent ."</td>
	</tr>";	
echo"
	</table></br></br>";

	
pg_close($con); 
?>

</body>
</html>
