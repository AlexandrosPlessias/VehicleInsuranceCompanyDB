<html>
<head>
	<title> Αρχική </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<style>
input[type=button] {
    width: 15em;  
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
pg_close($con); 
?>

<h2 align="left"> Λειτουργίες ΒΔ Ασφαλιστικής εταιρείας οχημάτων</h2>
<form><input type="button" value="   Εισαγωγή   " onClick="window.location.href='Insert/insertIndex.php'"></form> 
<br>
<form><input type="button" value="   Διαγραφή   " onClick="window.location.href='Delete/deleteIndex.php'"></form> 
<br>
<form><input type="button" value="  Παρουσιάσεις  " onClick="window.location.href='Presentations/presentationIndex.php'"></form> 
<br>
<form><input type="button" value="  Ερωτήματα   " onClick="window.location.href='Questions/questiontIndex.php'"></form> 

<br>

<h2 align="left"> Στοιχεία </h2>
<form><input type="button" value="  Ομάδα db1u36  " onClick="window.location.href='Credits/creditsIndex.php'"></form> 

</body>
</html>
