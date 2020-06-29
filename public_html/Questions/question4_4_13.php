<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title>Ερώτηση 4.4.13</title>
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

$query = "SELECT COUNT(per_id) FROM non_motorist_safety_equipment";// All nonBoard.
$rs = pg_query($con, $query) or die("Cannot execute query 4.4.13a: $query\n");
$rowQ1 = pg_fetch_row($rs); 
$allNonBoard = $rowQ1[0];


$query2 = "SELECT SUM(case when non_motorist_safety_equipment.msafeqmt=1 then 1 else 0 end) FROM non_motorist_safety_equipment";// All with MSAFEQMT=0.
$rs2 = pg_query($con, $query2) or die("Cannot execute query 4.4.13b: $query\n");
$rowQ2 = pg_fetch_row($rs2); 
$allNonBoardWithout = $rowQ2[0];


//calc persent
$div= (float)($allNonBoardWithout / $allNonBoard ) * 100;
$divRound = sprintf('%0.2f', $div);
$persent= pg_escape_string($divRound);

echo"<h2> Ερώτηση 4.4.13 </h2>
	<p>Βρείτε το ποσοστό  των μη-εποχούμενων οι οποίοι δεν χρησιμοποιούσαν μηχανισμό προστασίας. Αγνοείστε τις τιμές (MSAFEQMT=8,9).</p>
    <table border=\"1\" width=\"600\" >
	<tr> <td align=\"center\"><b>ALL NON BOARD</b></td> <td align=\"center\"><b>ALL NON BOARD WITHOUT EQUIP. </b></td> <td align=\"center\"><b>PERCENT(%)</b></td> </tr>";

echo"
	<tr>
		<td align=\"center\">". $allNonBoard."</td>
		<td align=\"center\">". $allNonBoardWithout."</td>
		<td align=\"center\">". $persent ."</td>
	</tr>";	
echo"
	</table></br></br>";

	
pg_close($con); 
?>

</body>
</html>
