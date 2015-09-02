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
  
  

//função de autocompletar
$SQLempresas = mysql_query("select distinct nome from empresa");
$todasEmpresas = array();

while ($row = mysql_fetch_row($SQLempresas)) {
  foreach($row as $key=>$value){
   array_push($todasEmpresas, $row[0]);
  }
}
$stringEmpresas = implode('","', $todasEmpresas);

$SQLnomes = mysql_query("select distinct contato from empresa");

$todosNomes = array();

while ($row = mysql_fetch_row($SQLnomes)) {
  foreach($row as $key=>$value){
   array_push($todosNomes, $row[0]);
  }
}

$stringNomes = implode('","', $todosNomes);


echo '<script> $(function() { var empresas = ["'.$stringEmpresas.'"]; var nomes= ["'.$stringNomes.'"]; $("#campoEmpresa" ).autocomplete({ source: empresas }); $("#campoNome" ).autocomplete({ source: nomes }); }); </script>';



	//div que controla o status dos Atendentes
	echo'<div class="statusAtendentes">';
	echo '<h3> Status Atendentes</h3>';
	$atendentes = mysql_query("SELECT nome,status,observacao from usuariosDk where id <> 37 and id <> 47 order by nome asc");
	
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
  echo '<a>Observação:</a><br><input type="text" name="observaAtende"><br>';
  echo '<select name="statusatende">';
  echo  '<option value="Disponivel">Disponivel</option>';
  echo  '<option value="Atendimento">Atendimento</option>';
  echo  '<option value="Ausente">Ausente</option>';
  echo '</select><br>';
  echo '<input type="submit" name="alteraAtend" value="Envia Status">';
  echo '</form>';
  echo '</div>';
	}
	
echo'</div>';

	
echo'<div class="centro">';





//parte de inserção de clientes
  echo '<h1>Inserir Clientes:</h1>';
  echo '<form action="insere.php" method="post">';
  echo '  <a title="Insira nome da empresa." id="campo" class="tooltip">Empresa:</a><br><input id="campoEmpresa" type="text" name="fempresa"/><br>';
  echo '  <a title="Insira nome do cliente." id="campo" class="tooltip">Nome:</a><br><input id="campoNome" type="text" name="fnome"/><br>';
  echo '  <a title="Insira o telefone, campo opcional." class="tooltip">Telefone:</a><br><input type="text" name="ftelefone"/>';
  echo'   <select name="selecao">';
  echo'     <option value="normal">Normal</option>';
  echo'     <option value="urgente">Urgente</option>';
  echo'   </select>';
  echo '  <input type="submit" class="button" value="Enviar"/>';
  echo '</form>';

  echo '<form action="index.php"  class="filtro "method="post">';
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
    echo'<div class="administrativo>';
    echo'<FORM METHOD="LINK" class="alteraSenha" ACTION="alteraSenhaFront.html">';
    echo'<INPUT TYPE="submit" VALUE="Alterar Senha">';
    echo'</FORM>';
    
	}
	session_start();
	  echo '<div class="ADM">';
	  if($_SESSION['tipo_user']=='adm'){
	  echo '<form method="post" action="cadastro.html">';
    echo'<input type="submit" value="Cadastrar Usuarios">';
    echo'</form>';
    echo '</div>';
	}
	  //Tools of acces only for logged.
  if($_SESSION['tipo_user']=='adm' or $_SESSION['tipo_user']=='normal'){
  echo '<form action="apagaAll.php" method="post">';
  echo '<div class="ferramentasAdm">';
  echo'<h3 class="titulo">Alteração de Retorno: </h3>';
	echo'<a>Observação de retorno: </a><br><input type="text" name="obsname"><br>';
  echo'<input type="submit" name="altera" class="altera" value="Altera Status">';
  echo'</div>';
  }

	
	$table = 'selecao';


	$statusR = $_POST['filtraR'];
	$statusA = $_POST['filtraA'];

	
	echo '<h3>Clientes para Ligar</h3>';
	
	
	if($statusR and !$statusA){
  $result2 = mysql_query("SELECT id,dateTime,nome,status,dateTimeAltera,observacao,atendente,telefone,tipo from ligacao where id <> 1 and status = 'R'  order by id desc") or die('cannot show columns from '.$table);
	}
	else if($statusA and !$statusR){
	  $result2 = mysql_query("SELECT id,dateTime,nome,status,dateTimeAltera,observacao,atendente,telefone,tipo from ligacao where id <> 1 and status = 'A'  order by id desc") or die('cannot show columns from '.$table);
	}
	else if($statusR and $statusA){
	  $result2 = mysql_query("SELECT id,dateTime,nome,status,dateTimeAltera,observacao,atendente,telefone,tipo from ligacao where id <> 1 and status in ('A','R')  order by id desc") or die('cannot show columns from '.$table);
	}
	else{
	  $result2 = mysql_query("SELECT id,dateTime,nome,status,dateTimeAltera,observacao,atendente,telefone,tipo from ligacao where id <> 1 order by id desc") or die('cannot show columns from '.$table);
	}


	echo '<table cellpadding="0" cellspacing="0" class="db-table">';
	echo '<tr><th>Altera <input type="checkbox" onClick="toggle(this)"/></th><th>Data Criacao</th><th>Cliente</th><th>Status</th><th>Data Alteração</th><th>Observação</th><th>Atendente</th></tr>';


	if(mysql_num_rows($result2)) {
	 
		while($row2 = mysql_fetch_row($result2)) {
			echo '<tr>';
			if($row2[3]=='R'){
			  echo '<td><input type="checkbox" name="desabilitado" value="'.$row2[0].'" disabled/>';
			}else{
			echo '<td><input type="checkbox" name="linhas[]" value="'.$row2[0].'">';
			}
			$b = false;
			foreach($row2 as $key=>$value) {
        if($row2[3]=='R'){
          $respondidos++;
        }else if($row2[3]=='A'){
          $abertos++;
        }
		    if(!$b) {
        $b = true;
        continue;
        }else{
          if($key == 7 or $key ==8){
            continue;
          }
           else if($key == 2 and !empty($row2[7]) and $row2[8] == 0){
            echo '<td title="Telefone: '.$row2[7].' " class="tooltip" >',$value,' </td>';
          }else if($key == 2 and !empty($row2[7]) and $row2[8] == 1){
            echo '<td title="Telefone: '.$row2[7].' " class="tooltip" >',$value,'<img src="warningAdvice.png" width="25px;"/> </td>';
          }else if($key == 2 and $row2[8] == 1){
            echo '<td class="urgente">',$value,'<img src="warningAdvice.png" width="25px;"/></td>';
          }else if($row2[3]=='A' and $key == 3){
            echo '<td class="aberto">',$value,' </td>';
          }else if($row2[3]=='R' and $key == 3){
            echo '<td class="retornado">',$value,' </td>';
          }else{
            echo '<td>',$value,' </td>';
          }
        }
      }
			echo '</tr>';
		}
		echo '</table><br />';
		session_start();
	  echo '</form>';
}

	echo '</div>';

	
	echo'</div>';
	
session_start();
	if($_SESSION['usuariolower']=='alex'){
	  echo'<img width=200 height=200 src="http://construcaoedecoracaodeapartamentos.com/wp-content/gallery/banquetas-para-a-sua-cozinha-util-e-decorativo/banquetas-para-cozinha1.jpg"/>';
    //echo'<iframe name="myiframe" src="http://servicos.deak.com.br" style="width:1200px; height:800px;"></iframe>';
	}
	
	//end connection
	mysql_close();


    



?>


</body>
</html>

