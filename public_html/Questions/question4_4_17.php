<html>
<head>
	<form><input type="button" value=" Ερωτήματα " onClick="window.location.href='/~db1u36/Questions/questiontIndex.php'"></form>
	<title>Ερώτηση 4.4.17</title>
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

echo"<h2> Ερώτηση 4.4.17 </h2>
	<p>Βρείτε ποια ήταν η κυριότερη αιτία καιρού για την πρόκληση των ατυχημάτων το φθινόπωρο και ποια την άνοιξη.</p>
	<br>";

// Επιλέγω κάθε κατάσταση καιρού.
$queryGetWeatherCondition="SELECT code FROM weather";
$rsGetWeatherCondition = pg_query($con, $queryGetWeatherCondition) or die("Cannot execute queryGetWeatherCondition: $queryGetWeatherCondition\n");
	
$accPerWeatherCondOfAut=array();
$accPerWeatherCΟndOfSpr=array();
	
while ($ro = pg_fetch_object($rsGetWeatherCondition)) {

	$weatherCondition=pg_escape_string($ro->code);
	
	// Εδω βρείσκω ΤΑ ΑΤΥΧΗΜΑΤΑ για κάθε συνθήκη καιρού για το ΦΘΙΝΌΠΩΡΟ(aut) δηλαδή τους μήνες(9,10,11).
	$queryAccPerWeatherCondOfAut = "SELECT SUM(case when weather='$weatherCondition' AND (month=9 OR month=10 OR month=11) then 1 else 0 end) FROM accident"; 
	$rsAccPerWeatherCondOfAut = pg_query($con, $queryAccPerWeatherCondOfAut) or die("Cannot execute queryAccPerWeatherCondOfAut : $queryAccPerWeatherCondOfAut\n");
	$rowAccPerWeatherCondOfAut = pg_fetch_row($rsAccPerWeatherCondOfAut); 
	array_push($accPerWeatherCondOfAut, $rowAccPerWeatherCondOfAut[0]);	
	
	// Εδω βρείσκω ΤΑ ΑΤΥΧΗΜΑΤΑ για κάθε συνθήκη καιρού για το ΆΝΟΙΞΗ(spr) δηλαδή τους μήνες(3,4,5).
	$queryAccPerWeatherCondOfSpr = "SELECT SUM(case when weather='$weatherCondition' AND (month=3 OR month=4 OR month=5) then 1 else 0 end) FROM accident"; 
	$rsAccPerWeatherCondOfSpr = pg_query($con, $queryAccPerWeatherCondOfSpr) or die("Cannot execute queryAccPerWeatherCondOfSpr : $queryAccPerWeatherCondOfSpr\n");
	$rowAccPerWeatherCondOfSpr = pg_fetch_row($rsAccPerWeatherCondOfSpr); 
	array_push($accPerWeatherCΟndOfSpr, $rowAccPerWeatherCondOfSpr[0]);	
	
}


// Εύρεση ΘΈΣΗΣ μεγαλύτερου για το ΦΘΙΝΌΠΩΡΟ.
$maxWeatherCondAut = array_keys($accPerWeatherCondOfAut, max($accPerWeatherCondOfAut));
// Εύρεση ΘΈΣΗΣ μεγαλύτερου για το ΆΝΟΙΞΗ.
$maxWeatherCondSpr = array_keys($accPerWeatherCΟndOfSpr, max($accPerWeatherCΟndOfSpr));


// Case ΦΘΙΝΌΠΩΡΟ(aut).
// Εύρεση περιγραφής για το αντίστοιχο WEATHER.
$queryGetWeatherCondNameAut="SELECT Description FROM weather WHERE code='$maxWeatherCondAut[0]'";
$rsGetWeatherCondNameAut = pg_query($con, $queryGetWeatherCondNameAut) or die("Cannot execute queryGetWeatherCondNameAut : $queryGetWeatherCondNameAut\n");
$rowGGetWeatherCondNameAut = pg_fetch_row($rsGetWeatherCondNameAut);
$weatherCondDescForAut=pg_escape_string($rowGGetWeatherCondNameAut[0]);
// Εμφανηση μυνήματος για το ΦΘΙΝΌΠΩΡΟ.
echo"Ήταν η  συνθήκη  <b>" .$weatherCondDescForAut. "</b> για το <b>φθινόπωρο</b>.";

echo "<br>";

// Case ΆΝΟΙΞΗ(spr).
// Εύρεση περιγραφής για το αντίστοιχο WEATHER.
$queryGetWeatherCondNameSpr="SELECT Description FROM weather WHERE code='$maxWeatherCondSpr[0]'";
$rsGetWeatherCondNameSpr = pg_query($con, $queryGetWeatherCondNameSpr) or die("Cannot execute queryGetWeatherCondNameSpr : $queryGetWeatherCondNameSpr\n");
$rowGetWeatherCondNameSpr = pg_fetch_row($rsGetWeatherCondNameSpr);
$weatherCondDescForSpr=pg_escape_string($rowGetWeatherCondNameSpr[0]);
// Εμφανηση μυνήματος για το ΆΝΟΙΞΗ.
echo"Ήταν η  συνθήκη  <b>" .$weatherCondDescForSpr. "</b> για την <b>άνοιξη</b>.";

		
pg_close($con); 
?>

</body>
</html>
