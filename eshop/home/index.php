<?php 
require("includes/conexion.php");

if(isset($_GET['accion']) && $_GET['accion']=="anyadir"){ 
   $id=intval($_GET['id']); 
   if(isset($_SESSION['carrito'][$id])){ 
      $_SESSION['carrito'][$id]['cantidad']++; 
   }else{ 
      //$sql_s="SELECT * FROM ti_desc_tip_producto where  =$id"; 
      $sql_s="SELECT * FROM ti_desc_tip_producto where id_idioma ='ES'"; 
      $query_s=mysqli_query($conexion, $sql_s); 
      if(mysqli_num_rows($query_s)!=0){ 
         $fila_s=mysqli_fetch_array($query_s);

         $_SESSION['carrito'][$fila_s['codigoComida']]=array( 
         "cantidad" => 1, 
         "precio" => $fila_s['precioComida']);
      }
  }
} 
 
?>
<!DOCTYPE html> 
<html lang="es">
<meta charset="UTF-8">  
 
<head> 
    <link rel="stylesheet" href="css/estilos.css" />  
    <title>Bienvenido a Vida Natural</title> 
</head> 

<body> 
    

<div class="container">
  <div class="jumbotron bg-white">
  <span class="text-success">
      <h1 class=" bg-white text-dark">Bienvenido a Vida Natural </h1> 
      <h4 class=" bg-white text-dark">La tienda donde econtrará aquello que busca</h4>
    </span>
    
  </div>  
</div>

<div class="table-responsive">


<table class="table table-hover" id="categorias" cellspacing=0> 

    <?php 

        $sql="CALL getCategories('ES')";        

        $query=mysqli_query($conexion, $sql); 

        while ($fila=mysqli_fetch_array($query)) { 
    ?> 
        <tr>             
            <td>            
            <?php echo $fila['descripcion'] ?>
            <blockquote class="blockquote">
            <p>
            <?php   echo $fila['comentario'] ?>
  </p> 
  <footer class="blockquote-footer bg-white"><?php  echo $fila['footer'] ?>dddd</footer> 
</blockquote>
            </td> 
            <td> <?php  echo '<a href="?menu=categoria&categoria='. $fila['id_tipo_producto'].' " title=""> 
              <img class="img-responsive" width="40%" height="40%" src="data:image/jpeg;base64,'.base64_encode( $fila['imagen'] ).'"/>';
                 ?>
            </a></br>
        </td>                   

        </tr> 
    <?php  } ?> 
</table>
</div>
<br>

</body> 
</html>