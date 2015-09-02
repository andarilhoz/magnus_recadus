<html>
  
  <head>
    <meta charset='UTF-8'>
   	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
   	<script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
   	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
   	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <title>Magnu's Recadus</title>
   	

	
	
	

  </head>

  <body>


    
  <script language="JavaScript" charset="UTF-8">
function toggle(source) {
  checkboxes = document.getElementsByName('linhas[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}


function limpa(){
	var texto = document.getElementById("campo")
	texto.submit();
	texto.reset();
}


function lockoutSubmit(button) {
    var oldValue = button.value;

    button.setAttribute('disabled', true);
    button.value = '...processing...';

    setTimeout(function(){
        button.value = 'Enviar';
        button.removeAttribute('disabled');
    }, 3000)
}


function checaBurro(){
	caixas = document.getElementById('select')
	if(caixas.checked){
		
	}
	else{
		//alert('Selecione uma ligação primeiro')
	}
}



//jQuery(function($){
//  $("#telefone").mask("(999) 999-9999");
//});





</script>




  
<?php
session_start();
$atendenteAtual = ucfirst($_SESSION['usuariolower']);

$filtro = false;

if($atendenteAtual == 'Felipe'){
  echo "<link rel='stylesheet' href='styleFelipe.css'/>";
}
else{
  echo "<link rel='stylesheet' href='style.css'/>";
}

$browser = $_SERVER['HTTP_USER_AGENT'];
$chrome = '/Chrome/';
$firefox = '/Firefox/';
$ie = '/MSIE/';

if (preg_match($chrome, $browser))
    $navegador = "Chrome";
if (preg_match($firefox, $browser))
    $navegador = "Firefox";
if (preg_match($ie, $browser))
    $navegador = "Ie";


if($navegador == "Chrome" or $navegador == "Firefox" ){

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




echo '<div class="total" id="conteudo">';

/*
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



$rodando = false;
//Header com aviso de treinamento:
echo '<div class="header">';

if ($date >= $dataTercaIni and $date <= $dataTercaFin) {
    echo '<a class="alerta">Estamos em treinamento até as 11:45</a>';
    $rodando = true;
    //echo $date;
}
if($date >= $dataQuintaIni and $date <= $dataQuintaFin) {
    echo '<a class="alerta">Estamos em treinamento até as 11:45</a>';
    $rodando = true;//echo $date;
}
if($horaTreina >= $dataDiasIni and $horaTreina <=$dataDiasFin and !$rodando){
  echo '<a class="alerta">Estamos em treinamento até as 11:45</a>';
}


*/


echo '</div>';




//Menu de Navegação
echo'<div class="navigation">';
echo'  <ul class="nav nav-justified">';
echo'    <li id="li" class="active"><a id="a" href="#"  onClick="onClickHome()">Home</a></li>';
echo'    <li id="li" class=""><a id="a" href="http://192.168.0.160/beta/historico.php" >Historico</a></li>';
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





	//div que controla o status dos Atendentes
	echo'<div class="statusAtendentes">';
	echo '<h3> Status Atendentes</h3>';
	$atendentes = mysql_query("SELECT nome,status,observacao from usuariosDk where id not in (2, 37, 47, 49)   order by nome asc");
	
	echo '<table cellpadding="0" cellspacing="0" class="db-table">';
	echo '<tr><th>Nome:</th><th>Status</th><th>Observação:</th></tr>';
		while($row2 = mysql_fetch_row($atendentes)) {
		  echo '<tr>';
		  foreach($row2 as $key=>$value) {
		    if($value == 'Disponivel'){
	        echo '<td class="Disponivel">',ucfirst($value),' </td>';
		    }
		    else if($value == 'Atendimento'){
		      echo '<td class="Atendimento">',ucfirst($value),' </td>';
		    }
		    else if($value =='Ausente'){
		      echo '<td class="Ausente">',ucfirst($value),' </td>';
		    }
		    else{
		      echo '<td>',ucfirst($value),' </td>';
		    }
		  }
		  echo '</tr>';
		}
	echo '</table>';
	session_start();
		if($_SESSION['tipo_user']=='adm' or $_SESSION['tipo_user']=='normal'){
	  //form to change logged status
  echo '<div class="AlteraStatus">';
  echo '<h4>Alteração de Status Atendente</h4>';
  echo '<form action="statusUser.php" method="post">';
  echo '<a>Observação:</a><br><input type="text" name="observaAtende" id="input-box"><br>';
  echo '<select name="statusatende">';
  echo  '<option value="Disponivel">Disponivel</option>';
  echo  '<option value="Atendimento">Atendimento</option>';
  echo  '<option value="Ausente">Ausente</option>';
  echo '</select><br>';
  echo '<input type="submit" name="alteraAtend" value="Envia Status">';
  echo '</form>';
  echo '</div>';
  
	}

//Chat------------------------------------------------------------------------



?>

	<br>
    <head> 
        <style>
        * { font-family:tahoma; font-size:12px; padding:0px; margin:0px; }
        p { line-height:18px; }
        div {margin-left:auto; margin-right:auto;}
        #content { background:#ddd; border-radius:5px; overflow-y: scroll;
                   border:1px solid #CCC; height: 160px; width: 260px; }
        #input { border-radius:2px; border:1px solid #ccc;
                 margin-top:10px; padding:5px; }
        #status { display:block; float:left; margin-top:15px; }
        </style>
    </head>
    <body>
        <div id="content"></div>
        <div>
            <span id="status">Connecting...</span>
            <input type="text" id="input" disabled="disabled" />
        </div>
 
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="http://192.168.0.160/exemplo/js/chat-frontend.js"></script>
	</body>
<?php

echo'</div>';



	
echo'<div class="centro">';





//parte de inserção de clientes
  echo '<h1>Inserir Clientes:</h1>';
  echo '<form action="insere.php" method="post" target="submission.frame" onsubmit="limpa()">';
  echo '  <a title="Insira nome da empresa." id="campo" class="tooltip">Empresa:</a><br><input id="campoEmpresa" type="text" name="fempresa"/><br>';
  echo '  <a title="Insira nome do cliente." id="campo" class="tooltip">Nome:</a><br><input id="campoNome" type="text" name="fnome"/><br>';
  echo '  <a title="Insira o telefone, campo opcional." class="tooltip">Telefone:</a><br><input type="tel" maxlength="15" name="ftelefone" />'; // <input type="number" id="telefone" name="ftelefone"/>';
  echo'   <select name="selecao">';
  echo'     <option value="normal">Normal</option>';
  echo'     <option value="urgente">Urgente</option>';
  echo'   </select><br>';
  echo'<a>Falar com: </a><select name = "destino">';
  echo '<option value= ""></option>';
	$encaminha = mysql_query("SELECT nome from usuariosDk order by nome asc");
  while($atend = mysql_fetch_row($encaminha)){
    foreach($atend as $key=>$value) {
      echo'<option value = "'.$atend[0].'">'.ucfirst($atend[0]).'</option>';  
    }
  }
    
  echo '</select>'
  ?>
  <input type="submit" onsubmit="lockoutSubmit(this)" />
  <input type="reset" value="Reset" />
  <?php
  echo '<iframe name="submission.frame" hidden></iframe>';
  echo '</form>';

  echo '<form action="filtra.php"  class="filtro "method="post">';
  echo '  <a>Filtrar por status</a> <br>';
  echo '  <a title="Retornado para o Cliente" class="tooltip">R</a><input type="checkbox" name ="filtraR" onClick="filtra(this)"/>';
  echo '  <a title="Ligação em Aberto" class="tooltip">A</a><input type="checkbox" name="filtraA" onClick="filtra(this)"/>';
  echo '  <input type="submit" class="button" value="Filtrar">';
  echo '</form>';
  echo '<div class="esquerda">';


/* show tables */

	

	
	
	session_start();
	

		if($_SESSION['tipo_user']=='adm' or $_SESSION['tipo_user']=='normal'){
	  $useratual = $_SESSION['usuariolower'];

    //ferramentas administrativas
    echo'<div class="administrativo">';
    echo'<FORM METHOD="LINK" class="alteraSenha" ACTION="alteraSenhaFront.html">';
    echo'<INPUT TYPE="submit" VALUE="Alterar Senha">';
    echo'</FORM>';
    
	}
	session_start();
	  if($_SESSION['tipo_user']=='adm'){
 	  echo '<div class="ADM">';   
	  echo '<form method="post" action="cadastro.html">';
    echo'<input type="submit" value="Cadastrar Usuarios">';
    echo'</form>';
    echo'</div>';
	}
	  //Tools of acces only for logged.
  if($_SESSION['tipo_user']=='adm' or $_SESSION['tipo_user']=='normal'){
    echo '<form action="apagaAll.php" method="post" target="submission.frame">';
    echo '<div class="ferramentasAdm">';
    echo'<h3 class="titulo">Alteração de Retorno: </h3>';
	  echo'<a>Observação de retorno: </a><br><input type="text"  id="input-box" name="obsname"><br>';
    echo'<input type="submit" name="altera" class="altera" value="Inicia Atendimento" onClick="checaBurro()">';
    echo'<input type="submit" name="alterafin" class="altera" value="Finaliza Atendimento" onClick="checaBurro()">';
  //NOVA FUNCIONALIDADE APAGAR LIGACOES
    if($_SESSION['tipo_user']=='adm'){
      echo'<h3 class="apagando">Apaga Ligacoes </h3>';
      echo'<input type="submit" name="apagando"  value="Apagar">';
    }
    echo'</div>';
  }

	
	$table = 'selecao';


	
	echo '<h3>Clientes para Ligar</h3>';
    echo '<iframe name="submission.frame" hidden></iframe>';

?>

<div charset="UTF-8" id="container">Loading ...</div>
</form>

    <script src="./socket.io.js" charset="UTF-8"></script>	
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
	
    <script>
	var counter = 0;
        // create a new websocket
        var socket = io.connect('http://192.168.0.160:8000');
        // on message received we print all the data inside the #container div
        socket.on('notification', function (data) {
        var usersList = "<table><tr><th>Altera</th><th>Data Criacao</th><th>Cliente</th><th>Status</th><th>Data Alteração</th><th>Observação</th><th>Atendente</th></tr>";
        $.each(data.ligacao,function(index,user){
            usersList += 
						 '<td><input type="checkbox" name="linhas[]" value="' + user.id +'" id="select"></td>' +
						 "<td>" + user.dateTime + "</td>" ;
			if(user.tipo == 1){
				usersList += "<td title='"+user.telefone+"' class='urgente'>" + user.nome + "<img src='warningAdvice.png' width='25px;'/></td>";
			}else{
				usersList += "<td title='"+user.telefone+"'>" + user.nome + "</td>" ;
			}
			usersList += "<td class='"+user.status+"'>" + user.status + "</td>" +
						 "<td>" + user.dateTimeAltera + "</td>" +
						 "<td>" + user.observacao + "</td>" +
						 "<td>" + user.atendente + "</td>" +						 
                         "</tr>";
        });
        usersList += "</table>";
        $('#container').html(usersList);  
		counter+=1
		//document.title = '('+counter+') Novo(s) Recado(s)';
		$('.total').focus(function() {
			alert( "Handler for .focus() called." );
		});
      });
	  window.onfocus = function () { document.title = 'Magnu\'s Recadus';  counter = 0 }
    </script>
	
<?
	


	
	//end connection
	mysql_close();

echo ' <div class = "home">';
echo '</div>';

echo'</div>';


echo'<div class="footer">';

echo'</div>';
}
if($navegador != "Chrome" and $navegador != "Firefox"  ){
  echo 'Use outro Navegador';
}
?>
</div>




</body>

</html>
