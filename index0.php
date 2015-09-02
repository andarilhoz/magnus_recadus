<html>
  
  <head>
    <!---->
    <link rel='stylesheet' href='style.css'/>
    <!--<meta http-equiv="refresh" content="60">-->
    <meta charset='UTF-8'>
   	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
   	<script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
   	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  </head>

  <body>


    
  <script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('linhas[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}



function limpa() {
if(document.getElementById('campo').value!="") {
document.getElementById('campo').value="";
}
}



function onClickHistorico(){
  $('.conteudo').load('historico.php');
  
  
}

function onClickHome(){
  $('.conteudo').load('home.php');
 
  
}




 $(function() {
 	 $(".home").load("home.php");
   var refreshId = setInterval(function() {
      $(".home").load('home.php?randval='+ Math.random());
   }, 60000);
   $.ajaxSetup({ cache: false });
});

</script>


  


  
<?php

date_default_timezone_set('America/Sao_Paulo');


$username = "ursosarmad";
$password = "newlife30*";
$hostname = "dbmy0012.whservidor.com"; 


//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("ursosarmad",$dbhandle) 
  or die("Could not select examples");





echo '<div class="total" id="conteudo">';

// mostra os dias de treinamento.
$tempo= time();
$date = date("w H:i ",$tempo);
$horaTreina = date("H:i",$tempo);


$dataTercaIni = '2 10:20';
$dataQuintaIni = '5 10:20';

$dataTercaFin = '2 11:30';
$dataQuintaFin = '5 11:30';

$dataDiasIni = '11:20';
$dataDiasFin = '11:45';


$objTercaIni = DateTime::createFromFormat('w H:i', $dataTercaIni);
$objQuintaIni = DateTime::createFromFormat('w H:i', $dataQuintaIni);
$objTercaFin = DateTime::createFromFormat('w H:i', $dataTercaFin);
$objQuintaFin = DateTime::createFromFormat('w H:i', $dataQuintaFin);
 
$objDiasIni = DateTime::createFromFormat('H:i', $dataDiasIni);
$objDiasFin = DateTime::createFromFormat('H:i', $dataDiasFin);




//Header com aviso de treinamento:
echo '<div class="header">';

if ($date >= $dataTercaIni and $date <= $dataTercaFin) {
    echo '<a class="alerta">Estamos em treinamento até as 11:30</a>';
    //echo $date;
}
if($date >= $dataQuintaIni and $date <= $dataQuintaFin) {
    echo '<a class="alerta">Estamos em treinamento até as 11:30</a>';
    //echo $date;
}
if($horaTreina >= $dataDiasIni and $horaTreina <=$dataDiasFin){
  echo '<a class="alerta">Estamos em treinamento até as 11:45</a>';
  //echo $date;
}

echo'<a class="detalhe">Para uma melhor experiencia, use o navegador Google Chrome </a>';

echo '</div>';




//Menu de Navegação
echo'<div class="navigation">';
echo'  <ul class="nav nav-justified">';
echo'    <li id="li" class="active"><a id="a" href="#"  onClick="onClickHome()">Home</a></li>';
echo'    <li id="li" class=""><a id="a" href="#" onClick="onClickHistorico()"  >Historico</a></li>';
echo'  </ul>';


echo'  <ul class="navLog">';
	//login/Logout
		session_start();
	  echo'<div class="loginlogout">';
	  if($_SESSION['tipo_user']!='adm' and $_SESSION['tipo_user']!='normal'){
	  echo'<li id="li"><a id="log" href="login.html">Login</a></li>';
  	}
  	
		if($_SESSION['tipo_user']=='adm' or $_SESSION['tipo_user']=='normal'){
	  $useratual = $_SESSION['usuariolower'];
    echo'<li id="li"><a id="log" href="logoff.php">Logoff</a></li>';
    
    echo '</div>';
		}
		
		echo '</ul>';
		

echo'</div>';



 
 
echo'<div class="conteudo">';
echo ' <div class = "home">';
echo '</div>';

echo'</div>';


echo'<div class="footer">';

echo'</div>';

mysql_close();
?>
</div>
</body>

</html>

