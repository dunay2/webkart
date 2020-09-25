<?php 
require("includes/conexion.php");

if(isset($_GET['accion']) && $_GET['accion']=="anyadir"){ 
   $id=intval($_GET['id']); 
   if(isset($_SESSION['carrito'][$id])){ 
      $_SESSION['carrito'][$id]['cantidad']++; 
   }else{ 
      //$sql="SELECT * FROM ti_desc_tip_producto where  =$id"; 
      $sql="SELECT * FROM ti_desc_tip_producto where id_idioma ='ES'"; 
      $query=mysqli_query($conexion, $sql); 
      if(mysqli_num_rows($query)!=0){ 
         $row=mysqli_fetch_array($query);

         $_SESSION['carrito'][$row['codigoComida']]=array( 
         "cantidad" => 1, 
         "precio" => $row['precioComida']);
      }
  }
} 
 
?>
 
    
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

        while ($row=mysqli_fetch_array($query)) { 
    ?> 
        <tr>             
            <td>            
            <?php echo $row['descripcion'] ?>
            <blockquote class="blockquote">
            <p>
            <?php   echo $row['comentario'] ?>
  </p> 
  <footer class="blockquote-footer bg-white"><?php  echo $row['footer'] ?></footer> 
</blockquote>
            </td> 
            <td> <?php  echo '<a href="?menu=categoria&categoria='. $row['id_tipo_producto'].' " title=""> 
              <img class="img-responsive" width="40%" height="40%" src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'"/>';
                 ?>
            </a></br>
        </td>                   

        </tr> 
    <?php  } ?> 
</table>
</div>
<br>

