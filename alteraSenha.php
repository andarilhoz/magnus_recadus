<meta http-equiv="refresh" content="3;url=index.php"> 
<?php

$username = "root";
$password = "newlife30*";
$hostname = "localhost";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");


//select a database to work with
$selected = mysql_select_db("ursosarmad",$dbhandle) 
  or die("Could not select examples");
  
$oldPassword = $_POST['oldpass'];
$newPassword = $_POST['newpass'];

session_start();
$usuario = $_SESSION['usuariolower'];

$criptOld = mysql_query("select md5('$oldPassword')");
$rowOld = mysql_fetch_array($criptOld);
$criptNew = mysql_query("select md5('$newPassword')");
$rowNew = mysql_fetch_array($criptNew);
$criptoNew = $rowNew['0']; 


$result = mysql_query("select * from usuariosDk where nome = '$usuario' limit 1");
$row = mysql_fetch_array($result);

if($row{'senha'} == $rowOld['0']){
  $SQL = mysql_query("UPDATE usuariosDk SET senha ='$criptoNew' where nome = '$usuario'");
  echo '<a>Senha Alterada com sucesso</a>';
}else{
  echo'<a>Senha Invalida</a>';
}

?>