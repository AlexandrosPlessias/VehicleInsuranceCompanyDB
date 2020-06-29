<html>
<head>
	<form><input type="button" class="button homeButton" value=" Αρχική " onClick="window.location.href='/~db1u36/index.php'"></form> 
	<title> Διαγραφή </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<style>
input.homeButton {
    width: 10em;  
    height: 3em;
    border: 3px solid #a1a1a1;
    border-radius: 25px;
}

input.delButton {
    width: 35em;  
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
<h2 align="left"> Διαγραφή </h2>

<form><input type="button" class="button delButton" value="Διαγραφή 3.1(α) ατυχημάτων " onClick="window.location.href='/~db1u36/Delete/delete3_1a.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(β) οχημάτων " onClick="window.location.href='/~db1u36/Delete/delete3_1b.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(γ) ατόμων " onClick="window.location.href='/~db1u36/Delete/delete3_1c.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(δ) ζημιών οχήματος " onClick="window.location.href='/~db1u36/Delete/delete3_1d.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(ε) παραγόντων οχήματος " onClick="window.location.href='/~db1u36/Delete/delete3_1e.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(στ) παραβάσεων οδηγού " onClick="window.location.href='/~db1u36/Delete/delete3_1f.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(ζ) αντικειμένων οπτικού πεδίου  " onClick="window.location.href='/~db1u36/Delete/delete3_1g.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(η) αντικειμένων αποφυγής " onClick="window.location.href='/~db1u36/Delete/delete3_1h.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(θ) ενεργειών/αντικειμένων απόσπασης προσοχής οδηγού " onClick="window.location.href='/~db1u36/Delete/delete3_1i.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(ι) σωματικές δυσλειτουργίες οδηγού  " onClick="window.location.href='/~db1u36/Delete/delete3_1j.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(ια) σωματικών δυσλειτουργιών μη-εποχούμενου " onClick="window.location.href='/~db1u36/Delete/delete3_1k.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(ιβ) ενεργειών μη-εποχούμενου την στιγμή της σύγκρουσης " onClick="window.location.href='/~db1u36/Delete/delete3_1l.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(ιγ) ενεργειών μη-εποχούμενου λίγο πριν την σύγκρουση " onClick="window.location.href='/~db1u36/Delete/delete3_1m.php'"></form> 
<form><input type="button" class="button delButton" value="Διαγραφή 3.1(ιδ) μηχανισμού προστασίας μη-εποχούμενου" onClick="window.location.href='/~db1u36/Delete/delete3_1n.php'"></form> 

</body>
</html>
