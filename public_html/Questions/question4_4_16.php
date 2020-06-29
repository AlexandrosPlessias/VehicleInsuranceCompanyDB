<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title>Ερώτηση 4.4.16</title>
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

// Επιλέγω κάθε κατάσταση φωτισμού.
$queryGetLightCondition="SELECT code FROM lgt_cond";
$rsGetLightCondition = pg_query($con, $queryGetLightCondition) or die("Cannot execute queryGetLightCondition: $queryGetLightCondition\n");

echo"<h2> Ερώτηση 4.4.16 </h2>
	<p>Βρείτε ποια ήταν η κυριότερη αιτία επίπεδου φωτισμού για την πρόκληση των ατυχημάτων τον χειμώνα και ποια το καλοκαίρι.</p>
	<br>";

$accPerLightCondOfWin=array();
$accPerLightCΟndOfSum=array();
	
while ($ro = pg_fetch_object($rsGetLightCondition)) {

	$ligthCondition=pg_escape_string($ro->code);
	
	// Εδω βρείσκω ΤΑ ΑΤΥΧΗΜΑΤΑ για κάθε συνθήκη φωτισμού για το ΧΕΙΜΩΝΑ(win) δηλαδή τους μήνες(2,11,12).
	$queryAccPerLightCondOfWin = "SELECT SUM(case when lgt_cond='$ligthCondition' AND (month=2 OR month=11 OR month=12) then 1 else 0 end) FROM accident"; 
	$rsAccPerLightCondOfWin = pg_query($con, $queryAccPerLightCondOfWin) or die("Cannot execute queryAccPerLightCondOfWin : $queryAccPerLightCondOfWin\n");
	$rowAccPerLightCondOfWin = pg_fetch_row($rsAccPerLightCondOfWin); 
	array_push($accPerLightCondOfWin, $rowAccPerLightCondOfWin[0]);	
	
	// Εδω βρείσκω ΤΑ ΑΤΥΧΗΜΑΤΑ για κάθε συνθήκη φωτισμού για το ΚΑΛΟΚΑΙΡΙ(sum) δηλαδή τους μήνες(6,7,8).
	$queryAccPerLightCondOfSum = "SELECT SUM(case when lgt_cond='$ligthCondition' AND (month=6 OR month=7 OR month=8) then 1 else 0 end) FROM accident"; 
	$rsAccPerLightCondOfSum = pg_query($con, $queryAccPerLightCondOfSum) or die("Cannot execute queryAccPerLightCondOfSum : $queryAccPerLightCondOfSum\n");
	$rowAccPerLightCondOfSumm = pg_fetch_row($rsAccPerLightCondOfSum); 
	array_push($accPerLightCΟndOfSum, $rowAccPerLightCondOfSumm[0]);	
	
}

// Εύρεση ΘΈΣΗΣ μεγαλύτερου για το ΧΕΙΜΩΝΑ.
$maxLightCondWin = array_keys($accPerLightCondOfWin, max($accPerLightCondOfWin));
// Εύρεση ΘΈΣΗΣ μεγαλύτερου για το ΚΑΛΟΚΑΙΡΙ.
$maxLightCondSum = array_keys($accPerLightCΟndOfSum, max($accPerLightCΟndOfSum));

//Προσθήκη +1 στην θέση του max μιας και οι ΘΈΣΕΙΣ ΤΟΥ ΠΊΝΑΚΑ(ΜΕΓΊΣΤΩΝ) ξεκινάνε από 0 ενώ του LGT_COND από 1.
$maxLightCondWin[0]++;
$maxLightCondSum[0]++;


// Case ΧΕΙΜΩΝΑ(win).
// Εύρεση περιγραφής για το αντίστοιχο lgt_cond.
$queryGetLightCondNameWin="SELECT Description FROM lgt_cond WHERE code='$maxLightCondWin[0]'";
$rsGetLightCondNameWin = pg_query($con, $queryGetLightCondNameWin) or die("Cannot execute queryGetLightCondNameWin : $queryGetLightCondNameWin\n");
$rowGetLightCondNameWin = pg_fetch_row($rsGetLightCondNameWin);
$ligthCondDescForWin=pg_escape_string($rowGetLightCondNameWin[0]);
// Εμφανηση μυνήματος για το ΧΕΙΜΩΝΑ.
echo"Ήταν η  συνθήκη  <b>" .$ligthCondDescForWin. "</b> για τον <b>χειμώνα</b>.";

echo "<br>";

// Case ΚΑΛΟΚΑΙΡΙ(sum).
// Εύρεση περιγραφής για το αντίστοιχο lgt_cond.
$queryGetLightCondNameSum="SELECT Description FROM lgt_cond WHERE code='$maxLightCondSum[0]'";
$rsGetLightCondNameSum = pg_query($con, $queryGetLightCondNameSum) or die("Cannot execute queryGetLightCondNameSum : $queryGetLightCondNameSum\n");
$rowGetLightCondNameSum = pg_fetch_row($rsGetLightCondNameSum);
$ligthCondDescForSum=pg_escape_string($rowGetLightCondNameSum[0]);
// Εμφανηση μυνήματος για το ΚΑΛΟΚΑΙΡΙ.
echo"Ήταν η  συνθήκη  <b>" .$ligthCondDescForSum. "</b> για το <b>καλοκαίρι</b>.";

		
pg_close($con); 
?>

</body>
</html>
