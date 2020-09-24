   <?php 
  
    $server="localhost"; 
    $user="webuser"; 
    $pass="1q2w3e4r"; 
    $db="webkart"; 
      
    // connect to mysql       
    //$conexion = mysqli_connect($server, $user, $pass) or die("Error al conectar al servidor."); 
    $conexion = new mysqli($server, $user, $pass, $db) or die("Error al conectar al servidor.");
    $conexion->query("SET NAMES 'UTF8'");
        
    //Create connection and select DB
   // $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    mysqli_select_db($conexion, $db) or die("Error al conectar al servidor de base de datos."); 
?>