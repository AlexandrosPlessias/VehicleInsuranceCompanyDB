<html>
<head>
	<form><input type="button" value=" Αρχική " onClick="window.location.href='/~db1u36/index.php'"></form> 
	<title> Ερωτήματα </title>
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
pg_close($con); 
?>
<h2 align="left"> Ερωτήματα </h2>

<form><input type="button" value="Ερώτηση 4.4.1 " onClick="window.location.href='/~db1u36/Questions/question4_4_1.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.2 " onClick="window.location.href='/~db1u36/Questions/question4_4_2.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.3 " onClick="window.location.href='/~db1u36/Questions/question4_4_3.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.4 " onClick="window.location.href='/~db1u36/Questions/question4_4_4.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.5 " onClick="window.location.href='/~db1u36/Questions/question4_4_5.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.6 " onClick="window.location.href='/~db1u36/Questions/question4_4_6.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.7 " onClick="window.location.href='/~db1u36/Questions/question4_4_7.php'"></form>
<form><input type="button" value="Ερώτηση 4.4.8 " onClick="window.location.href='/~db1u36/Questions/question4_4_8.php'"></form>
<form><input type="button" value="Ερώτηση 4.4.9 " onClick="window.location.href='/~db1u36/Questions/question4_4_9.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.10" onClick="window.location.href='/~db1u36/Questions/question4_4_10.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.11" onClick="window.location.href='/~db1u36/Questions/question4_4_11.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.12" onClick="window.location.href='/~db1u36/Questions/question4_4_12.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.13" onClick="window.location.href='/~db1u36/Questions/question4_4_13.php'"></form>
<form><input type="button" value="Ερώτηση 4.4.14" onClick="window.location.href='/~db1u36/Questions/question4_4_14.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.15" onClick="window.location.href='/~db1u36/Questions/question4_4_15.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.16" onClick="window.location.href='/~db1u36/Questions/question4_4_16.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.17" onClick="window.location.href='/~db1u36/Questions/question4_4_17.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.19" onClick="window.location.href='/~db1u36/Questions/question4_4_19.php'"></form> 
<form><input type="button" value="Ερώτηση 4.4.21" onClick="window.location.href='/~db1u36/Questions/question4_4_21.php'"></form> 
</body>
</html>
