<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title> Ερώτηση 4.4.12 </title>
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
$query = "SELECT per_id,Description FROM non_motorist_prior,mpr_act where non_motorist_prior.mpr_act=mpr_act.code"; 
$rs = pg_query($con, $query) or die("Cannot execute query 4.4.12: $query\n");

echo"<h2> Ερώτηση 4.4.12 </h2> 
	<p>Βρείτε τους μη-εποχούμενους και τις αντίστοιχες ενέργειες τους λίγο πριν την σύγκρουση και δώστε την περιγραφή τούς για κάθε μια από αυτές. Αγνοείστε τις τιμές (MPR_ACT = 98,99).</p>
    <table border=\"1\" width=\"600\" >
	<tr> <td align=\"center\"><b>PER_ID</b></td> <td align=\"center\"><b>DESCRIPTION</b></td> </tr>";
	
while ($ro = pg_fetch_object($rs)) {	
		echo"
			<tr>
				<td align=\"center\">". $ro->per_id ."</td>
				<td align=\"center\">". $ro->description ."</td>
			</tr>";	
}
echo"
	</table></br></br>";
	
pg_close($con); 
?>

</body>
</html>
