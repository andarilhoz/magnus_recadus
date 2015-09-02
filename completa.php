<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> 
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<title>
		Untitled Document
	</title>
</head>
<body>
  
  
  
<input type="text" id="esporte" placeholder="Informe um esporte"/>

<?php
$username = "root";
$password = "newlife30*";
$hostname = "localhost";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";

//select a database to work with
$selected = mysql_select_db("ursosarmad",$dbhandle) 
  or die("Could not select examples");


$SQLempresas = mysql_query("select nome from empresa");

$todas = array();

while ($row = mysql_fetch_row($SQLempresas)) {
  foreach($row as $key=>$value){
   array_push($todas, $row[0]);
  }
}

$stringEmpresas = implode('","', $todas);


    

echo '<script> $(function() { var esportes = ["'.$stringEmpresas.'"]; $("#esporte" ).autocomplete({ source: esportes }); }); </script>';

?>
</body>
</html>

