<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title>Ερώτηση 4.4.15</title>
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
$queryGetDay="SELECT code FROM day_week";
$rsGetDay = pg_query($con, $queryGetDay) or die("Cannot execute query 4.4.15: $query\n");

echo"<h2> Ερώτηση 4.4.15 </h2>
	<p>Βρείτε ποια μέρα της εβδομάδας έγιναν τα περισσότερα ατυχήματα το 2012.</p>
	<br>";

$accPerDay2012=array();
	
while ($ro = pg_fetch_object($rsGetDay)) {

	$day=pg_escape_string($ro->code);
	// Εδω βρείσκω ΤΑ ΑΤΥΧΗΜΑΤΑ ΤΗΣ ΜΕΡΑΣ ΤΟΥ 2012.
	$queryAccPerDayOf2012 = "SELECT SUM(case when day='$day' AND year=2012 then 1 else 0 end) FROM accident"; 
	$rsAccPerDayOf2012 = pg_query($con, $queryAccPerDayOf2012) or die("Cannot execute queryAccPerDayOf2012 : $queryAccPerDayOf2012\n");
	$rowAccPerDayOf2012 = pg_fetch_row($rsAccPerDayOf2012); 
	array_push($accPerDay2012, $rowAccPerDayOf2012[0]);	
}

// Εύρεση ΘΈΣΗΣ μεγαλύτερου.
$maxPos = array_keys($accPerDay2012, max($accPerDay2012));

//Προσθήκη +1 στην θέση του max μιας και οι ΘΈΣΕΙΣ ΤΟΥ ΠΊΝΑΚΑ(ΜΕΓΊΣΤΩΝ) ξεκινάνε από 0 ενώ του DAY_WEEK από 1.
$maxPos[0]++;


// Εύρεση περιγραφής για το αντίστοιχο day_week.
$queryGetDayName="SELECT Description FROM day_week WHERE code='$maxPos[0]'";
$rsDayName = pg_query($con, $queryGetDayName) or die("Cannot execute queryGetDayName : $queryGetDayName\n");
$rowDayName = pg_fetch_row($rsDayName);
$dayDescName=pg_escape_string($rowDayName[0]);
// Εμφανηση μυνήματος.
echo"Είναι η <b>".$dayDescName."</b> με <b>".$accPerDay2012[$maxPos[0]]. "</b> ατυχήματα.";

		
pg_close($con); 
?>

</body>
</html>
