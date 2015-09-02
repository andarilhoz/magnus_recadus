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
  
$observacao = $_POST['observaAtende'];
$statusAtendente = $_POST['statusatende'];
  
session_start();
$usuario = $_SESSION['usuariolower'];



$sql = mysql_query("update usuariosDk set observacao ='$observacao', status='$statusAtendente' where nome='$usuario' ");

      if (!mysql_query($sql,$dbhandle)){
       echo $observacao; // die('Error: ' . mysql_error() .$button);
       echo $statusAtendente;
       echo $atual;
        
      }else{
        echo "Alterado Status com sucesso.";
 
      }


header("location:index.php");


?>