   <?php 
  
    $server="localhost"; 
    $user="webuser"; 
    $pass="1q2w3e4r"; 
    $db="webkart"; 
      
    // connect to mysql       
    $conexion = mysqli_connect($server, $user, $pass) or die("Error al conectar al servidor."); 
    $conexion->query("SET NAMES 'UTF8'");
        
    mysqli_select_db($conexion, $db) or die("Error al conectar al servidor de base de datos."); 
?>