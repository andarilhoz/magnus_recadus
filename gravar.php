<?php
// Pra escrever no arquivo usamos o seguinte codigo:
session_start();
$nick = ucfirst($_SESSION['member_username']); 
if(empty($nick)){
  $nick = 'Gerente';
}
// Pega o que está escrito no campo de nome nick \\

$texto = $_POST['texto']; 
// Pega o que está escrito no campo de nome texto \\


$texto = str_replace("(bk)", "<img width='50' hight='70' src='banq.jpg'>", "$texto");




$abre = fopen("chat.html", "a");
 // Abre o arquivo chat.txt com a opção a (abre para leitura e escrita) \\

if($abre) {

fwrite($abre,"$nick : $texto <br>\n");
// Se conseguir abrir o arquivo ele escreve o conteudo com fwrite \\

}

fclose($abre);
// Fecha o arquivo \\

?>

<meta http-equiv="refresh" content="0; url=chat.html#final">
 <!-- Redireciona para o arquivo chat.txt //-->