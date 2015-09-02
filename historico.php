<html>
  <head>
    <meta charset='UTF-8'>    
    <link rel='stylesheet' href='style.css'/>
  </head>
  
  <body>
    
    <div class="totalHist">
    
    
      <?php
      
date_default_timezone_set('America/Sao_Paulo');


$username = "root";
$password = "newlife30*";
$hostname = "localhost";


//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("ursosarmad",$dbhandle) 
  or die("Could not select examples");




$dataIni = date('Y-m-d H:i:s' , strtotime($_POST['dataIni']));
$dataFim1 = date('Y-m-d H:i:s' , strtotime($_POST['dataFim']));
$dataFim = date('Y-m-d H:i:s' , strtotime("$dataFim1 + 24 hours"));



if($dataIni == '1969-12-31 21:00:00'){
	$sqlQuantidade = mysql_query("SELECT count(id) from historico where id <> 1 ") or die('cannot show columns from '.$table);
}
else{
  $sqlQuantidade = mysql_query("SELECT count(id) from historico where id <> 1 and dateCriado BETWEEN '$dataIni' and '$dataFim'") or die('cannot show columns from '.$table);
}

if(mysql_num_rows($sqlQuantidade)) {
	  while($row2 = mysql_fetch_row($sqlQuantidade)) {
	    foreach($row2 as $key=>$value) {
	      $resultado = $value;

	      }
	    }
  
}


//Menu de Navegação
echo'<div class="navigation">';
echo'  <ul class="nav nav-justified">';
echo'    <li id="li" class="active"><a id="a" href="http://glowarrow.com.br/Dk/">Home</a></li>';
echo'    <li id="li" class=""><a id="a" href="http://glowarrow.com.br/Dk/historico.php" >Historico</a></li>';
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





          echo '<div class="cabecalho">';
          //Imprime o cabeçalho
          echo '<form method="post" link="historico.php">';
          echo' <a>Filtro:</a><br>';
          echo '<span class="inicio">';
          echo '<a>Data Inicio: </a><br><input type="date" name="dataIni">';
          echo '</span>';
          echo '<span class="final">';
          echo '<a>Data Final: </a><br><input type="date" name="dataFim">';
          echo '</span>';
          echo '<input type="submit" value="Enviar"/>';
          echo '</form>';
          echo $resultado.' Registros encontrados';
          echo '<table cellpadding="0" cellspacing="0" class="db-table">';
          echo '<tr><th>Data Criacao</th><th>Cliente</th><th>Status</th><th>Data Alteração</th><th>Observação</th><th>Atendente</th></tr>';
          //Consulta no BD
          
          if($dataIni == '1969-12-31 21:00:00'){
        	$result2 = mysql_query("SELECT dateTime,nome,status,dateTimeAltera,observacao,atendente from historico where id <> 1 order by dateCriado desc limit 30") or die('cannot show columns from '.$table);
          }
          else{
          $result2 = mysql_query("SELECT dateTime,nome,status,dateTimeAltera,observacao,atendente from historico where id <> 1 and dateCriado BETWEEN '$dataIni' and '$dataFim' order by dateCriado asc") or die('cannot show columns from '.$table);
          }
          	if(mysql_num_rows($result2)) {
          	  while($row2 = mysql_fetch_row($result2)) {
          	    echo '<tr>';
          	 foreach($row2 as $key=>$value) {
          	     echo '<td>',$value,' </td>';
          	   }
          	   }
          	}
          echo'</table>';

          	  

          
          
          
          echo '</div>';

          
          
          
          
          mysql_close();
          
      ?>  
      
      
      
      
    </div>
  </body>

<html>