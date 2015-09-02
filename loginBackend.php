
  <?php
  date_default_timezone_set('America/Sao_Paulo');
  
  


$username = "root";
$password = "newlife30*";
$hostname = "localhost";

    //connection to the database
    $dbhandle = mysql_connect($hostname, $username, $password) 
    or die("Unable to connect to MySQL");
    echo "Connected to MySQL<br>";

    //select a database to work with
    $selected = mysql_select_db("ursosarmad",$dbhandle) 
      or die("Could not select examples");


    $tempo= time();
    $date = date("H:i:s d-m-Y ",$tempo);
    
    $usernameTyped = strtolower($_POST[user]);
    $passwordTyped = $_POST[password];

    session_start();
    $_SESSION['member_username']=$_POST[user];
    $sqlCript = mysql_query("select md5('$passwordTyped')");
    $rowC = mysql_fetch_array($sqlCript);
    $cript = $rowC['0'];
    $_SESSION['password']= $cript;
    $_SESSION['usuariolower']=strtolower($_POST[user]);
	$ses_id = session_id();

    //execute the SQL query and return records

    $result = mysql_query("SELECT * from usuariosDk where nome = '$usernameTyped' ");
    $row = mysql_fetch_array($result);

    if ($row{'nome'} === $usernameTyped && $row{'nome'} != ''){
      if($row{'senha'}=== $cript){
        if($row{'tipo'} == 0){
          $_SESSION['tipo_user']='adm';
        }
        if($row{'tipo'} == 1){
          $_SESSION['tipo_user']='normal';
        }

        $posta = mysql_query("update usuariosDk set dateLoginReal = '$date', status = 'Disponivel', cookie = '$ses_id' where nome = '$usernameTyped'");
        //echo 'Login efetuado com sucesso.';
        //echo $row{'senha'};
        header("location:index.php");
      }
      else{
        echo 'Usuario ou senha invalido';
        echo $cript;
        echo $row{'senha'};
      }
    }
    else{
      echo 'Usuario ou senha invalido';
      echo $cript;
      echo $row{'senha'};
    }

  ?>

