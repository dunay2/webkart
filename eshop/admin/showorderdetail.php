<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header('Location: login.php');
  exit;
}

 require_once ("includes/conexion.php");

  $sql = 'CALL getOrderDetail('.$id.');';
  
  $conexion->next_result();
  
  $query = $conexion->query($sql);
?>
<div class="container">
<table class="table table-striped ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nif</th>
      <th scope="col">Email</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Dirección</th>
      <th scope="col">CP</th>
      <th scope="col">poblacion</th>
      <th scope="col">pais</th>      
      
    </tr>
  </thead>
  <tbody>

<?php

$cont=0;
   $row=mysqli_fetch_array($query);
   
    echo '<tr>';
    echo '<th scope="row">'.++$cont.'</th>';    
    echo '<td>'.$row['nif'].'</td>';
    echo '<td>'.$row['email'].'</td>';
    echo '<td>'.$row['nombreenv'].'</td>';
    echo '<td>'.$row['apellidoenv'].'</td>';
    echo '<td>'.$row['direccionenv'].'</td>';
    echo '<td>'.$row['codigo_postalenv'].'</td>';
    echo '<td>'.$row['poblacionenv'].'</td>';
    echo '<td>'.$row['pais'].'</td>';
    
    echo '</tr>';      

 ?>
  </tbody>

  <tfoot>
    <tr>
      <td colspan=6>
      <div class="card-body">
    <h5 class="card-title"></h5>
    <p class="card-text"></p>
    <a href="?menu=showorders" class="btn btn-primary stretched-link">Volver</a>
  </div>

      </td>
</tr>
        
    </tfoot>
  </table>


         
            
            


</div> 

 