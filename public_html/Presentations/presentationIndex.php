<html>
<head>
	<form><input type="button" class="button homeButton" value=" Αρχική " onClick="window.location.href='/~db1u36/index.php'"></form> 
	<title> Παρουσίαση </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<style>
input.homeButton {
    width: 10em;  
    height: 3em;
    border: 3px solid #a1a1a1;
    border-radius: 25px;
}

input.presentButton {
    width: 30em;  
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
<h2 align="left"> Παρουσίαση </h2>

<form><input type="button" class="button presentButton" value="Παρουσίαση 4.1 ατυχημάτων και οχημάτων " onClick="window.location.href='/~db1u36/Presentations/presentation4_1.php'"></form> 
<form><input type="button" class="button presentButton" value="Παρουσίαση 4.2 οχημάτων και εποχούμενων " onClick="window.location.href='/~db1u36/Presentations/presentation4_2.php'"></form> 
<form><input type="button" class="button presentButton" value="Παρουσίαση 4.3 ατυχημάτων και μη-εποχούμενων " onClick="window.location.href='/~db1u36/Presentations/presentation4_3.php'"></form> 


</body>
</html>
