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

    $usernameTyped = strtolower($_POST['user']);
    $passwordTyped = $_POST['password'];
    $typeSelected = $_POST['tipo'];

    $query = mysql_query("SELECT * from usuariosDk where nome = '$usernameTyped'");
    $row = mysql_fetch_array($query);
    $cript = mysql_query("select md5('$passwordTyped')");
      if($row{'nome'}!=$usernameTyped){
       
       if($typeSelected == 'adm'){
            $result = mysql_query("Insert into usuariosDk (nome,senha,tipo,status) values('$usernameTyped','$cript','0','Atendimento')");
            echo'Usuario adm cadastrado com sucesso';
            echo ""+ $usernameTyped.length;
          
        }
        
        if($typeSelected == 'normal'){
              $result = mysql_query("Insert into usuariosDk (nome,senha,tipo,status) values('$usernameTyped','$cript','1','Atendimento')");
              echo'Usuario cadastrado com sucesso';

           }
        
      }
        else{       
          echo '<a>Usuario já existente</a>';
        }
  ?>

