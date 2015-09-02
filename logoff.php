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

session_start();
$user =  $_SESSION['usuariolower'];

$posta = mysql_query("update usuariosDk set status = 'Ausente' where nome = '$user' ");

$_SESSION['member_username'] = '';








session_destroy();

header("location:index.php");

?>

Deslogado com sucesso.

