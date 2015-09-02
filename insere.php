<?php

date_default_timezone_set('America/Sao_Paulo');

$username = "root";
$password = "newlife30*";
$hostname = "localhost";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";

//select a database to work with
$selected = mysql_select_db("ursosarmad",$dbhandle) 
  or die("Could not select examples");


//Verifica nomes duplicados
$verificaUltima = mysql_query("SELECT nome from ligacao order by id desc limit 1");
$rowVerify = mysql_fetch_row($verificaUltima);
	foreach($rowVerify as $key=>$value) {
		$nomeUltimo = $value;
	}



$jaCadastrado = 0;

$tempo= time();
$date = date("H:i:s d-m-Y  ",$tempo);

$nome = strtoupper($_POST[fnome]);
$telefone =$_POST[ftelefone];
$empresa = strtoupper($_POST[fempresa]);
$total = $empresa." - ".$nome;
$tipo = $_POST[selecao];
$ipNoProxy = $_SERVER['REMOTE_ADDR'];
$ipProxy = $_SERVER['HTTP_X_FORWARDED_FOR'];
$destino = $_POST['destino'];


/*validação empresa
if (stripos(strtolower($empresa), 'alex') !== false) {
    // 'see details' is in the $line
    $empresa = '';
}


//validação empresa
if(str_word_count($empresa, 0) > 1 or str_word_count($nome, 0) > 1){
  $empresa = '';
  $nome = '';
  header("location:index.php");
}
*/



if(!empty($telefone)){
  if (preg_match('/^[A-Za-z]+$/', $telefone)) {
    echo'invalido';
    $telefone = '';
  }
  else{
    echo 'valido';
  }
}

//check telefone
if(empty($telefone)){
  $selectTel = mysql_query("SELECT * from empresa where nome = '$empresa' and contato = '$nome'");
  $rowTel = mysql_fetch_array($selectTel);
  $telefone = $rowTel{'telefone'};
}






if($tipo == 'normal'){
  $urgencia = 0;  
}else{
  $urgencia = 1;
}


if(strpos(($nome),'URGENTE') or strpos(($empresa),'URGE') or strpos(($telefone),'URGE')){
  header("location:index.php");
}



if($nome == $nomeUltimo){
  die('Usuario já acrescentado');
}else{


if(strlen($nome) < 3 or strlen($empresa) < 1){
  header("location:index.php");
}else{
  $idSQL = "SELECT id from ligacao order by id desc limit 1";
  $qry = mysql_query($idSQL,$dbhandle) or die('cannot show columns from '.$table); 
  $row2 = mysql_fetch_row($qry);
  
	foreach($row2 as $key=>$value) {
		$id = $value;
	}
  $id++;
  
  if(empty($destino)){
    $sql1 = "INSERT INTO ligacao (id,dateTime,nome,status,dateTimeAltera,observacao,atendente,telefone,tipo,ipNoProxy,ipProxy,destino) VALUES ($id,'$date','$total','A','$date', '&nbsp;',' &nbsp;','$telefone',$urgencia, '$ipNoProxy', '$nomeMaquina', '$destino')";
  }else{
    $sql1 = "INSERT INTO ligacao (id,dateTime,nome,status,dateTimeAltera,observacao,atendente,telefone,tipo,ipNoProxy,ipProxy,destino) VALUES ($id,'$date','$total','A','$date', 'Falar com: ".ucfirst($destino)."',' &nbsp;','$telefone',$urgencia, '$ipNoProxy', '$nomeMaquina', '$destino')";
  }
  $sqlVerificaExistencia = mysql_query("SELECT * from empresa");
  
  		while($row2= mysql_fetch_row($sqlVerificaExistencia)) {
		  foreach($row2 as $key=>$value) {
		    if($row2[1] == $empresa and $row2[2] == $nome){
		      if(empty($row2[3])){
		        $updateTelefone = mysql_query("update empresa set telefone = '$telefone' where nome = '$empresa' and contato = '$nome'");
		      }
		      $jaCadastrado++;
		      echo $jaCadastrado;
		    }else{
		      
		      
		    }
		  }
		}
  
    if($jaCadastrado == 0){
      //echo 'entrou';
      $sql2 = "INSERT INTO empresa (nome,contato,telefone) VALUES ('$empresa','$nome','$telefone')";
      if (!mysql_query($sql2,$dbhandle))
      {
        die('Error: ' . mysql_error());
      }else{
       // header("location:index.php");
        }
    }

  
  if (!mysql_query($sql1,$dbhandle))
    {
    die('Error: ' . mysql_error());
    }else{
 // header("location:index.php");
  }
}


/*   $arquivo = "
  
    <html>
    <head>
      <meta charset='UTF-8'>
    </head>
       <a> Ligar para: $nome</a>
       </a> atualizado as: $date</a>
    </html>
    ";

  $emailenviar = "glowarrow@gmail.com";
    $destino =  "alex.lopes@deak.com.br";
    $assunto = "MagnusRecadus Atualização";
 
    // É necessário indicar que o formato do e-mail é html
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From: MagnusRecadus ";
    //$headers .= "Bcc: $EmailPadrao\r\n";
     
    $enviaremail = mail($destino, $assunto, $arquivo, $headers);
    if($enviaremail){
    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
    echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
    } else {
    $mgm = "ERRO AO ENVIAR E-MAIL!";
    echo "";
    }*/
   // header("location:index.php");
    
}
mysql_close();
header("location:index.php");

?>