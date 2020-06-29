<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title>Ερώτηση 4.4.11</title>
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
$query = "SELECT per_id FROM non_motorist_crash GROUP BY per_id  HAVING COUNT(non_motorist_crash.mtm_crsh)>=2"; // Εδω βρείσκω τους per_id για πανω από 2 ενέργειες.
$rs = pg_query($con, $query) or die("Cannot execute query 4.4.11: $query\n");

echo"<h2> Ερώτηση 4.4.11 </h2>
	<p>Βρείτε τους μη-εποχούμενους των οποίων οι ενέργειες την στιγμή της σύγκρουσης ήταν τουλάχιστον 2 και δώστε την περιγραφή για κάθε μια από αυτές. Αγνοείστε τις τιμές (MTM_CRSH = 98,99).</p>
    <table border=\"1\" width=\"600\" >
	<tr> <td align=\"center\"><b>PER_ID</b></td> <td align=\"center\"><b>DESCRIPTION</b></td> </tr>";


while ($ro = pg_fetch_object($rs)) {
		// Για τον καθενα άτομο (per_id)
		$peridT=pg_escape_string($ro->per_id);
		$query2 = "SELECT per_id,description FROM non_motorist_crash,mtm_crsh WHERE non_motorist_crash.per_id='$peridT' AND non_motorist_crash.mtm_crsh=mtm_crsh.code"; // Εδω βρείσκω τους veh_id για πανω από 3 ζημιές.
		$rs2 = pg_query($con, $query2) or die("Cannot execute query2 : $query2\n");
		
		while($ro2 = pg_fetch_object($rs2)){
		echo"
			<tr>
				<td align=\"center\">". $ro2->per_id ."</td>
				<td align=\"center\">". $ro2->description ."</td>
			</tr>";	
		}
}

echo"
	</table></br></br>";

	
pg_close($con); 
?>

</body>
</html>
