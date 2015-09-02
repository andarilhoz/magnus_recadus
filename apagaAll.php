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
  
  

$tempo= time();
$date = date("H:i:s d-m-Y ",$tempo);

$linha = $_POST['linhas'];
//$selectOption = $_POST['selecao'];
$selectOption = 'R';
$observa = $_POST['obsname'];
session_start();
$atendente = ucfirst($_SESSION['member_username']);
$lowerNome = strtolower($_SESSION['member_username']);
$id = 0;


//NOVA FUNCIONALIDADE
if(isset($_POST['apagando'])){
  for($i = 0; $i <= count($linha); $i++){
    $var =  $linha[$i];
    $sqlApagar = mysql_query("delete from ligacao where id = $var");
  }
}



echo count($linha);
  if(empty($linha)) 
  {
    echo("Nada selecionado.");
   // header("location:index.php");
  } 
  else if(count($linha) <=  1)
  {
    $N = count($linha);
    for($i=0; $i < $N; $i++)
    {
      $id = $linha[$i];
    }
  
  
  echo $id;
  
  $selectLiga = mysql_query("SELECT * FROM ligacao where id = $id");
  echo $selectLiga;
    	if(mysql_num_rows($selectLiga)) {
	 		  while($rowFirst = mysql_fetch_array($selectLiga)) {
	 		    $liStatus = $rowFirst{'status'};
	 		    $liObs = $rowFirst{'observacao'};
	 		    
	    	}
  	}
  	
  	
      //busca o ultimo registro para enviar para o historico
        $sqlTake = mysql_query(" SELECT id,dateTime,nome,status,dateTimeAltera,observacao,atendente from ligacao where id = $id limit 1"); //or die('cannot show columns from '.$table);

  	if(mysql_num_rows($sqlTake)) {
	 		  while($row2 = mysql_fetch_row($sqlTake)) {
        $nome = $row2[2];
        $dateIni = $row2[1];
	    	$observaHist = $row2[5];
	 		    
	 		  }
  	}
  	

  echo $liStatus;
  if($liStatus == 'A'){
   if($id != 1 and isset($_POST['altera'])){
      $sql2 = mysql_query("update ligacao set status='$selectOption',dateTimeAltera= '$date', observacao = '$observa', atendente='$atendente' where id = $id");
  
  	  //update status do atendente
      $sqlAtendente = mysql_query("UPDATE usuariosDk set status = 'Atendimento', observacao = '$nome' where nome = '$lowerNome'");

   }
  }
      
  else if($liStatus == 'R'){
        
     if($id != 1 and isset($_POST['alterafin'])){
      echo "entrou";
      $sqlverificaObserva = mysql_query("select observacao from ligacao where id = $id");
      
     	if(mysql_num_rows($sqlverificaObserva)) {
	 		  while($row3 = mysql_fetch_row($sqlverificaObserva)) {
          $resultado = $row3[0];
	    	}
  	}
        if(!empty($observa)){
        $sql2 = mysql_query("update ligacao set dateTimeAltera= '$date', observacao = '$observa', status = 'F' where id = $id");
        $sql3 = mysql_query("INSERT IGNORE INTO historico (dateTime,nome,status,dateTimeAltera,observacao,atendente) VALUES ('$dateIni','$nome','R','$date','$observa','$atendente')");
        }else{
        $sql2 = mysql_query("update ligacao set dateTimeAltera= '$date', status = 'F' where id = $id");
        $sql3 = mysql_query("INSERT IGNORE INTO historico (dateTime,nome,status,dateTimeAltera,observacao,atendente) VALUES ('$dateIni','$nome','R','$date','$observaHist','$atendente')");
        }
        $sqlAtendente = mysql_query("UPDATE usuariosDk set status = 'Disponivel', observacao = '' where nome = '$lowerNome'");



      //insere o histórico
    }
  }
    else if($liStatus == 'F'){
      
       echo'entrou1';
     if($id != 1 and isset($_POST['alterafin'])){
       echo'entrou2';
      $sqlverificaObserva = mysql_query("select observacao from ligacao where id = $id");
      
     	if(mysql_num_rows($sqlverificaObserva)) {
	 		  while($row3 = mysql_fetch_row($sqlverificaObserva)) {
          $resultado = $row3[0];
	    	}
  	}
        if(!empty($observa)){
        $sql2 = mysql_query("update ligacao set dateTimeAltera= '$date', observacao = '$observa', status = 'F' where id = $id");
        $updateHistorico = mysql_query("update historico set observacao = '$observa' where dateTime = '$dateIni'");
        echo'<br>',$dateIni,'<br>',$observa;
        }

      //  header("location:index.php");
    }else{
      
    }

  //header("location:index.php");
  

}
else{
  
}

}else{
  echo"Por agora, selecione apenas uma linha";
}

mysql_close();
header("location:index.php");



?>