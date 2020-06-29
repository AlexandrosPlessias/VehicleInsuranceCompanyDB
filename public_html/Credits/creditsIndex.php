<html>
<head>
	<form><input type="button" value=" Αρχική " onClick="window.location.href='/~db1u36/index.php'"></form> 
	<title> Στοιχεία </title>
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
<h2 align="left"> Ομάδα db1u36 </h2>

<table border="1" width="600" >
	<tr> <td align="center"><b> ΕΠΙΘΕΤΟ </b></td> <td align="center"><b> ΟΝΟΜΑ </b></td> <td align="center"><b> Α.Μ. </b></td> <td align="center"><b> EMAIL </b></td> </tr>
	<tr> <td align="center"> Εξαδάκτυλος  </td> <td align="center"> Ανδρέας </td> <td align="center"> 2025201200123 </td> <td align="center"> cst12123@uop.gr </td> </tr>
	<tr> <td align="center"> Πλέσσιας </td> <td align="center"> Αλέξανδρος </td> <td align="center"> 2025201100068 </td> <td align="center"> cst11068@uop.gr </td> </tr>
</table>
	
</body>
</html>
